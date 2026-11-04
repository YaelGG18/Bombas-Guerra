<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Refaccion;
use Exception;

class CotizController extends Controller
{
    public function index()
    {
        $refacciones = Refaccion::all(); 
        return view('cotizaciones', compact('refacciones'));
    }

    public function generarCotizacion(Request $request)
    {
        // 1. Validaciones (Aseguramos que el teléfono e input de cliente vengan requeridos)
        $request->validate([
            'cliente'   => 'required',
            'telefono'  => 'nullable|string|max:20', // Validamos el teléfono
            'falla'     => 'required',
            'mano_obra' => 'nullable|numeric'
        ]);

        $manoObra = $request->filled('mano_obra') ? floatval($request->input('mano_obra')) : 0.00;
        
        $refaccionesStr = $request->input('refacciones', '[]');
        $refacciones = is_string($refaccionesStr) ? json_decode($refaccionesStr, true) : $refaccionesStr;

        $totalMateriales = 0.00;
        if (is_array($refacciones)) {
            foreach ($refacciones as $item) {
                $totalMateriales += (floatval($item['precio']) * intval($item['cantidad']));
            }
        }
        $totalServicio = $totalMateriales + $manoObra;

        try {
            DB::beginTransaction();

            $nombreClienteInput = $request->input('cliente');
            // Si el formulario de cotizaciones no tiene un campo separado para teléfono, puedes usar uno genérico o asegurarte de pedirlo. 
            // Aquí capturamos el teléfono del request o asignamos uno predeterminado si el formulario no lo envía por separado.
            $telefonoInput = $request->input('telefono', 'S/N');

            // 2. BUSCAR O REGISTRAR CLIENTE USANDO SU TELÉFONO O NOMBRE
            $clienteExistente = DB::table('cliente')
                ->where('nombreCliente', $nombreClienteInput)
                ->orWhere('telefono', $telefonoInput)
                ->first();

            if ($clienteExistente) {
                $idCliente = $clienteExistente->idCliente;
                // Actualizamos los datos por si hubo algún cambio
                DB::table('cliente')->where('idCliente', $idCliente)->update([
                    'nombreCliente' => $nombreClienteInput,
                    'telefono'      => $telefonoInput !== 'S/N' ? $telefonoInput : $clienteExistente->telefono
                ]);
            } else {
                $idCliente = DB::table('cliente')->insertGetId([
                    'nombreCliente' => $nombreClienteInput,
                    'telefono'      => $telefonoInput
                ]);
            }

            // 3. Insertar Orden de Trabajo con estado 'En Proceso' por defecto
            $idCotizacion = DB::table('orden_trabajo')->insertGetId([
                'idCliente'        => $idCliente,
                'folioOT'          => 'OT-' . rand(1000, 9999),
                'diagnosticoFalla' => $request->input('falla'),
                'costoManoObra'    => $manoObra,
                'estadoOT'         => 'En Proceso',
                'fechaCreacion'    => now()
            ]);

            // 4. Insertar detalles y descontar stock del inventario
            if (is_array($refacciones) && count($refacciones) > 0) {
                $detalles = [];
                foreach ($refacciones as $item) {
                    $detalles[] = [
                        'idOT'                    => $idCotizacion,
                        'idRefaccion'             => $item['id_refaccion'],
                        'cantidad'                => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'], 
                    ];

                    DB::table('refacciones')
                        ->where('id', $item['id_refaccion'])
                        ->decrement('stock', $item['cantidad']);
                }
                DB::table('detalle_ot')->insert($detalles);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Cotización aprobada y convertida a OT con éxito. Folio OT #' . $idCotizacion);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        }
    }
}