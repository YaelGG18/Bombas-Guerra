<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialReporteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Pestaña activa por defecto ('ot' o 'ventas')
        $tabActiva = $request->input('tab', 'ot');

        // 1. Consultar Historial de Órdenes de Trabajo (usando nombres reales de tu BD)
        $queryOT = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'orden_trabajo.*', 
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($search) {
            $queryOT->where('orden_trabajo.folioOT', 'like', "%$search%")
                    ->orWhere('cliente.nombreCliente', 'like', "%$search%");
        }
        
        $ordenes = $queryOT->get();

        // 2. Consultar Historial de Ventas Directas (usando nombres reales de tu BD)
        $queryVentas = DB::table('venta_directa')
            ->leftJoin('cliente', 'venta_directa.idCliente', '=', 'cliente.idCliente')
            ->select(
                'venta_directa.*', 
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($search) {
            $queryVentas->where('venta_directa.folioVenta', 'like', "%$search%")
                        ->orWhere('cliente.nombreCliente', 'like', "%$search%");
        }
        
        $ventas = $queryVentas->get();

        // Retornamos todas las variables necesarias a la vista para evitar errores de variables indefinidas
        return view('historial_movimientos', compact('ordenes', 'ventas', 'tabActiva'));
    }
}