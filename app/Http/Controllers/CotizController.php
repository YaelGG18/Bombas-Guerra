<?php


namespace App\Http\Controllers;

use App\Models\Refaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Patrón Facade nativo de Laravel
use App\Models\OrdenTrabajo;
use Exception;

class CotizController extends Controller
{

public function index()
{
    // Obtenemos todas las refacciones (puedes filtrar por stock > 0 si lo deseas)
    $refacciones = Refaccion::all(); 
    return view('cotizaciones', compact('refacciones'));
}
    public function generarCotizacion(Request $request)
    {
        // 1. Validación
        $request->validate([
            'cliente' => 'required',
            'falla' => 'required',
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
            // Patrón Facade: Inicia transacción
            DB::beginTransaction();

            // Insertar Cotización usando el Modelo
            $cotizacion = OrdenTrabajo::create([
                'idCliente' => $request->input('cliente'), 
                'falla' => $request->input('falla'),
                'manoObra' => $manoObra,
                'estado' => 'Cotizacion',
                'fecha' => now()->toDateString()
            ]);

            // Insertar Detalles (2FN: Precio Histórico)
            if (is_array($refacciones) && count($refacciones) > 0) {
                $detalles = [];
                foreach ($refacciones as $item) {
                    $detalles[] = [
                        'idOT' => $cotizacion->id,
                        'idRefaccion' => $item['id_refaccion'],
                        'cantidad' => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'], 
                    ];
                }
                DB::table('detalleot')->insert($detalles);
            }

            // Patrón Facade: Confirma transacción
            DB::commit();

            return redirect()->back()->with('success', 'Cotización #' . $cotizacion->id . ' generada. Total: $' . number_format($totalServicio, 2));

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al generar cotización: ' . $e->getMessage());
        }
    }
}