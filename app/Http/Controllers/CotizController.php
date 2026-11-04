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
        $request->validate([
            'cliente'   => 'required',
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

            // 1. Buscar o registrar cliente automáticamente
            $nombreClienteInput = $request->input('cliente');
            $clienteExistente = DB::table('cliente')->where('nombreCliente', $nombreClienteInput)->first();

            if ($clienteExistente) {
                $idCliente = $clienteExistente->idCliente;
            } else {
                $idCliente = DB::table('cliente')->insertGetId([
                    'nombreCliente' => $nombreClienteInput,
                    'telefono'      => 'S/N' // Valor por defecto si no se ingresó en el formulario
                ]);
            }

            // 2. Insertar Orden de Trabajo con estado 'En Proceso' por defecto
            $idCotizacion = DB::table('orden_trabajo')->insertGetId([
                'idCliente'        => $idCliente,
                'folioOT'          => 'OT-' . rand(1000, 9999),
                'diagnosticoFalla' => $request->input('falla'),
                'costoManoObra'    => $manoObra,
                'estadoOT'         => 'En Proceso', // Por defecto en proceso
                'fechaCreacion'    => now()
            ]);

            // 3. Insertar detalles y DESCONTAR DEL INVENTARIO (stock)
            if (is_array($refacciones) && count($refacciones) > 0) {
                $detalles = [];
                foreach ($refacciones as $item) {
                    $detalles[] = [
                        'idOT'                    => $idCotizacion,
                        'idRefaccion'             => $item['id_refaccion'],
                        'cantidad'                => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'], 
                    ];

                    // Descontar la pieza utilizada de la tabla 'refacciones'
                    DB::table('refacciones')
                        ->where('id', $item['id_refaccion'])
                        ->decrement('stock', $item['cantidad']);
                }
                DB::table('detalle_ot')->insert($detalles);
            }

            DB::commit();

            return redirect()->back()->with('success', '¡Orden de trabajo generada con éxito y stock actualizado! Folio OT #' . $idCotizacion);

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        }
    }
}