<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialReporteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tabActiva = $request->input('tab', 'ot');
        
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // 1. Consultar Historial de Órdenes de Trabajo
        $queryOT = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'orden_trabajo.*', 
                'cliente.nombreCliente',
                'cliente.telefono'
            )
            // Agregamos la subconsulta para calcular el total de las refacciones de esta OT
            ->addSelect([
                'refaccionesTotal' => DB::table('detalle_ot')
                    ->whereColumn('detalle_ot.idOT', 'orden_trabajo.idOT')
                    ->selectRaw('COALESCE(SUM(cantidad * precioUnitarioHistorico), 0)')
            ]);

        if ($search) {
            $queryOT->where(function($q) use ($search) {
                $q->where('orden_trabajo.folioOT', 'like', "%$search%")
                  ->orWhere('cliente.nombreCliente', 'like', "%$search%");
            });
        }

        if ($fechaInicio && $fechaFin) {
            $queryOT->whereBetween('orden_trabajo.fechaCreacion', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
        }
        
        $ordenes = $queryOT->get();

        // 2. Consultar Historial de Ventas Directas
        $queryVentas = DB::table('venta_directa')
            ->leftJoin('cliente', 'venta_directa.idCliente', '=', 'cliente.idCliente')
            ->select(
                'venta_directa.*', 
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($search) {
            $queryVentas->where(function($q) use ($search) {
                $q->where('venta_directa.folioVenta', 'like', "%$search%")
                  ->orWhere('cliente.nombreCliente', 'like', "%$search%");
            });
        }

        if ($fechaInicio && $fechaFin) {
            $queryVentas->whereBetween('venta_directa.fechaVenta', [$fechaInicio . ' 00:00:00', $fechaFin . ' 23:59:59']);
        }
        
        $ventas = $queryVentas->get();

        return view('historial_movimientos', compact('ordenes', 'ventas', 'tabActiva', 'fechaInicio', 'fechaFin', 'search'));
    }
}