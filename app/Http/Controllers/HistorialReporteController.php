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
        
        // Capturar los valores de los filtros de fecha por si vienen en la URL
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        // 1. Consultar Historial de Órdenes de Trabajo
        $queryOT = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'orden_trabajo.*', 
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($search) {
            $queryOT->where(function($q) use ($search) {
                $q->where('orden_trabajo.folioOT', 'like', "%$search%")
                  ->orWhere('cliente.nombreCliente', 'like', "%$search%");
            });
        }

        // Aplicar filtro de fechas si el usuario las seleccionó
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

        // Enviamos todas las variables necesarias a la vista (incluyendo las fechas y la pestaña activa)
        return view('historial_movimientos', compact('ordenes', 'ventas', 'tabActiva', 'fechaInicio', 'fechaFin'));
    }
}