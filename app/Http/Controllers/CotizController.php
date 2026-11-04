<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizController extends Controller
{
    public function index()
    {
        // 1. Obtenemos las refacciones con stock disponible para el catálogo de cotización
        $refacciones = DB::table('refaccion')
            ->join('marca', 'refaccion.idMarca', '=', 'marca.idMarca')
            ->join('categoria_pieza', 'refaccion.idCategoria', '=', 'categoria_pieza.idCategoria')
            ->select(
                'refaccion.idRefaccion',
                'refaccion.nombre',
                'refaccion.cantidadStock',
                'refaccion.precioVentaActual',
                'marca.nombreMarca as marca',
                'categoria_pieza.nombreCategoria as categoria'
            )
            ->where('refaccion.cantidadStock', '>', 0)
            ->get();

        // 2. Recuperamos el carrito de cotización desde la sesión (o vacío si no existe)
        $carrito = session()->get('cotizacion_carrito', []);
        
        // 3. Calculamos el subtotal de las refacciones en el carrito
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['subtotal'];
        }

        return view('cotizaciones', compact('refacciones', 'carrito', 'total'));
    }

    public function agregar(Request $request)
    {
        $idRefaccion = $request->input('idRefaccion');
        $refaccion = DB::table('refaccion')->where('idRefaccion', $idRefaccion)->first();

        if (!$refaccion) {
            return back()->with('error', 'La refacción seleccionada no existe.');
        }

        $carrito = session()->get('cotizacion_carrito', []);

        // Si ya está en el carrito, aumentamos la cantidad
        if (isset($carrito[$idRefaccion])) {
            if ($carrito[$idRefaccion]['cantidad'] + 1 > $refaccion->cantidadStock) {
                return back()->with('error', 'Stock insuficiente para agregar más unidades.');
            }
            $carrito[$idRefaccion]['cantidad']++;
            $carrito[$idRefaccion]['subtotal'] = $carrito[$idRefaccion]['cantidad'] * $carrito[$idRefaccion]['precio'];
        } else {
            // Si es nuevo en el carrito
            $carrito[$idRefaccion] = [
                'idRefaccion' => $refaccion->idRefaccion,
                'nombre'      => $refaccion->nombre,
                'precio'      => $refaccion->precioVentaActual,
                'cantidad'    => 1,
                'subtotal'    => $refaccion->precioVentaActual
            ];
        }

        session()->put('cotizacion_carrito', $carrito);
        return back()->with('success', 'Refacción agregada a la cotización.');
    }

    public function quitar(Request $request)
    {
        $idRefaccion = $request->input('idRefaccion');
        $carrito = session()->get('cotizacion_carrito', []);

        if (isset($carrito[$idRefaccion])) {
            unset($carrito[$idRefaccion]);
            session()->put('cotizacion_carrito', $carrito);
        }

        return back()->with('success', 'Refacción retirada de la cotización.');
    }

    public function aprobar(Request $request)
    {
        $request->validate([
            'telefono'         => 'required|string|max:20',
            'nombreCliente'    => 'required|string|max:150',
            'diagnosticoFalla' => 'required|string',
            'costoManoObra'    => 'required|numeric|min:0'
        ]);

        $carrito = session()->get('cotizacion_carrito', []);
        if (empty($carrito)) {
            return back()->with('error', 'No puedes aprobar una cotización sin refacciones en el carrito.');
        }

        try {
            DB::beginTransaction();

            // 1. Buscar o registrar al cliente automáticamente
            $cliente = DB::table('cliente')->where('telefono', $request->telefono)->first();
            if ($cliente) {
                $idCliente = $cliente->idCliente;
            } else {
                $idCliente = DB::table('cliente')->insertGetId([
                    'nombreCliente' => $request->nombreCliente,
                    'telefono'      => $request->telefono
                ]);
            }

            // 2. Generar Folio Único para la Orden de Trabajo
            $folioOT = 'OT-' . date('Ymd') . '-' . rand(100, 999);

            // 3. Crear la Orden de Trabajo utilizando los nombres de columnas correctos (3FN)
            $idOT = DB::table('orden_trabajo')->insertGetId([
                'folioOT'          => $folioOT,
                'idCliente'        => $idCliente,
                'idUsuario'        => 1, // Usuario por defecto del sistema
                'diagnosticoFalla' => $request->diagnosticoFalla,
                'costoManoObra'    => $request->costoManoObra,
                'estadoOT'         => 'En Proceso',
                'fechaCreacion'    => now()
            ]);

            // 4. Registrar los detalles de la orden y descontar inventario de cada refacción
            foreach ($carrito as $item) {
                DB::table('detalle_ot')->insert([
                    'idOT'                    => $idOT,
                    'idRefaccion'             => $item['idRefaccion'],
                    'cantidad'                => $item['cantidad'],
                    'precioUnitarioHistorico' => $item['precio']
                ]);

                // Descontar stock actual de la tabla refaccion
                DB::table('refaccion')
                    ->where('idRefaccion', $item['idRefaccion'])
                    ->decrement('cantidadStock', $item['cantidad']);
            }

            // 5. Limpiar el carrito de la sesión
            session()->forget('cotizacion_carrito');

            DB::commit();

            return redirect('/ordenes_trabajo')->with('success', '¡Cotización aprobada con éxito! Se generó la Orden de Trabajo: ' . $folioOT);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al procesar la cotización: ' . $e->getMessage());
        }
    }
}