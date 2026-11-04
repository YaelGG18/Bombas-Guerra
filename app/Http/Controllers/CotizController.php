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
        // Traemos todas las refacciones para el buscador
        $refacciones = Refaccion::all(); 
        return view('cotizaciones', compact('refacciones'));
    }

    // Método para procesar el formulario
    public function generarCotizacion(Request $request)
    {
        // 1. Validaciones
        $request->validate([
            'cliente' => 'required',
            'falla' => 'required',
            'mano_obra' => 'nullable|numeric'
        ]);

        $manoObra = $request->filled('mano_obra') ? floatval($request->input('mano_obra')) : 0.00;
        
        // El JSON oculto generado por JS se decodifica a un array de PHP
        $refaccionesStr = $request->input('refacciones', '[]');
        $refacciones = is_string($refaccionesStr) ? json_decode($refaccionesStr, true) : $refaccionesStr;

        // 2. Cálculos matemáticos backend por seguridad
        $totalMateriales = 0.00;
        if (is_array($refacciones)) {
            foreach ($refacciones as $item) {
                $totalMateriales += (floatval($item['precio']) * intval($item['cantidad']));
            }
        }
        $totalServicio = $totalMateriales + $manoObra;

        try {
            DB::beginTransaction();

            // 3. Insertar maestro (estado: Cotizacion)
            $idCotizacion = DB::table('ordentrabajo')->insertGetId([
                'idCliente' => $request->input('cliente'), // Cambiar por ID si manejas tabla clientes
                'falla' => $request->input('falla'),
                'manoObra' => $manoObra,
                'estado' => 'Cotizacion',
                'fecha' => now()->toDateString()
            ]);

            // 4. Insertar detalles (2FN: Guardando precio histórico)
            if (is_array($refacciones) && count($refacciones) > 0) {
                $detalles = [];
                foreach ($refacciones as $item) {
                    $detalles[] = [
                        'idOT' => $idCotizacion,
                        'idRefaccion' => $item['id_refaccion'],
                        'cantidad' => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'], 
                    ];
                }
                DB::table('detalleot')->insert($detalles);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Cotización #' . $idCotizacion . ' generada con éxito. Total: $' . number_format($totalServicio, 2));

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error en la base de datos: ' . $e->getMessage());
        }
    }
}