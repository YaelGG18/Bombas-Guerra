<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialReporteController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin    = $request->input('fecha_fin');
        $search      = $request->input('search');
        $tabActiva   = $request->input('tab', 'ot');

        // Si el usuario acaba de entrar y los inputs de fecha vienen por defecto pero no hay búsqueda ni intención manual, 
        // puedes decidir si quieres que liste todo o arranque vacío. 
        // Para asegurar que veas tu venta de prueba de inmediato, quitamos la restricción estricta de fecha por defecto:
        
        // --- 1. CONSULTA DE ÓRDENES DE TRABAJO ---
        $queryOT = DB::table('orden_trabajo')
            ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'orden_trabajo.*',
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($fechaInicio) {
            $queryOT->whereDate('orden_trabajo.fechaCreacion', '>=', $fechaInicio);
        }
        if ($fechaFin) {
            $queryOT->whereDate('orden_trabajo.fechaCreacion', '<=', $fechaFin);
        }
        if ($search) {
            $queryOT->where(function($q) use ($search) {
                $q->where('orden_trabajo.folioOT', 'LIKE', "%{$search}%")
                  ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                  ->orWhere('orden_trabajo.diagnosticoFalla', 'LIKE', "%{$search}%");
            });
        }

        // Si no hay ningún filtro aplicado, devolvemos colección vacía para las OT
        $ordenes = (!$fechaInicio && !$fechaFin && !$search) ? collect() : $queryOT->orderBy('orden_trabajo.fechaCreacion', 'desc')->get();

        foreach ($ordenes as $ot) {
            $detalles = DB::table('detalle_ot')->where('idOT', $ot->idOT)->get();
            $subtotalRefacciones = $detalles->sum(fn($item) => $item->cantidad * $item->precioUnitarioHistorico);
            $ot->refaccionesTotal = $subtotalRefacciones;
            $ot->totalGeneral     = $subtotalRefacciones + $ot->costoManoObra;
        }

        // --- 2. CONSULTA DE VENTAS DIRECTAS ---
        $ventas = collect();
        try {
            $queryVentas = DB::table('venta_directa');

            if ($fechaInicio) {
                $queryVentas->whereDate('created_at', '>=', $fechaInicio);
            }
            if ($fechaFin) {
                $queryVentas->whereDate('created_at', '<=', $fechaFin);
            }
            if ($search) {
                $queryVentas->where(function($q) use ($search) {
                    $q->where('folioTicket', 'LIKE', "%{$search}%")
                      ->orWhere('clienteMostrador', 'LIKE', "%{$search}%");
                });
            }

            // Ojo: Si quieres que muestre las ventas sin requerir filtro forzoso de fecha, 
            // quitamos la condicion de vacio o dejamos que traiga todo si no hay búsqueda estricta:
            $ventas = $queryVentas->orderBy('idVenta', 'desc')->get();

        } catch (\Exception $e) {
            // En caso de error
        }

        return view('historial_movimientos', compact('ordenes', 'ventas', 'fechaInicio', 'fechaFin', 'search', 'tabActiva'));
    }
}