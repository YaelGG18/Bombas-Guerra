<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Refaccion; // Importamos el modelo de tu inventario
use Exception;

class CotizController extends Controller
{
    // Método para cargar la página
    public function index()
    {
        // Traemos todas las refacciones usando tu tabla 'refacciones'
        $refacciones = Refaccion::all(); 
        return view('cotizaciones', compact('refacciones'));
    }

    // Método para procesar el formulario
    ublic function generarCotizacion(Request $request)
    {
        // 1. Validaciones
        $request->validate([
            'cliente'   => 'required', // Puede ser el nombre o teléfono del cliente
            'falla'     => 'required',
            'mano_obra' => 'nullable|numeric'
        ]);

        $manoObra = $request->filled('mano_obra') ? floatval($request->input('mano_obra')) : 0.00;
        
        // El JSON oculto generado por JS se decodifica a un array de PHP
        $refaccionesStr = $request->input('refacciones', '[]');
        $refacciones = is_string($refaccionesStr) ? json_decode($refaccionesStr, true) : $refaccionesStr;

        // Cálculos matemáticos backend por seguridad
        $totalMateriales = 0.00;
        if (is_array($refacciones)) {
            foreach ($refacciones as $item) {
                $totalMateriales += (floatval($item['precio']) * intval($item['cantidad']));
            }
        }
        $totalServicio = $totalMateriales + $manoObra;

        try {
            DB::beginTransaction();

            // 2. BUSCAR O CREAR CLIENTE AUTOMÁTICAMENTE
            // Como el input 'cliente' recibe texto, verificamos si ya existe en la tabla. Si no, lo insertamos para obtener su ID numérico real.
            $nombreClienteInput = $request->input('cliente');
            $clienteExistente = DB::table('cliente')->where('nombreCliente', $nombreClienteInput)->first();

            if ($clienteExistente) {
                $idCliente = $clienteExistente->idCliente;
            } else {
                $idCliente = DB::table('cliente')->insertGetId([
                    'nombreCliente' => $nombreClienteInput,
                    'telefono'      => 'N/A' // Teléfono temporal si el formulario solo manda el nombre
                ]);
            }

            // 3. Insertar maestro en 'orden_trabajo' usando el ID numérico correcto ($idCliente)
            $idCotizacion = DB::table('orden_trabajo')->insertGetId([
                'idCliente'        => $idCliente, // <--- Aquí va el ID numérico correcto
                'folioOT'          => 'OT-' . rand(1000, 9999),
                'diagnosticoFalla' => $request->input('falla'),
                'costoManoObra'    => $manoObra,
                'estadoOT'         => 'Cotizacion',
                'fechaCreacion'    => now()
            ]);

            // 4. Insertar detalles (Guardando precio histórico) en 'detalle_ot'
            if (is_array($refacciones) && count($refacciones) > 0) {
                $detalles = [];
                foreach ($refacciones as $item) {
                    $detalles[] = [
                        'idOT'                    => $idCotizacion,
                        'idRefaccion'             => $item['id_refaccion'],
                        'cantidad'                => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'], 
                    ];
                }
                DB::table('detalle_ot')->insert($detalles);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Cotización #' . $idCotizacion . ' generada con éxito. Total: $' . number_format($totalServicio, 2));

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        }
    }