<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialReporteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // 1. Consultar Historial de Órdenes de Trabajo
        $queryOT = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select('orden_trabajo.*', 'cliente.nombreCliente');

        if ($search) {
            $queryOT->where('orden_trabajo.folioOT', 'like', "%$search%")
                    ->orWhere('cliente.nombreCliente', 'like', "%$search%");
        }
        
        $ordenes = $queryOT->get();

        // 2. Consultar Historial de Ventas Directas
        $queryVentas = DB::table('venta_directa')
            ->leftJoin('cliente', 'venta_directa.idCliente', '=', 'cliente.idCliente')
            ->select('venta_directa.*', 'cliente.nombreCliente');

        if ($search) {
            $queryVentas->where('venta_directa.folioVenta', 'like', "%$search%")
                        ->orWhere('cliente.nombreCliente', 'like', "%$search%");
        }
        
        $ventas = $queryVentas->get();

        // Retornar ambas variables a la vista
        return view('historial_movimientos', compact('ordenes', 'ventas'));
    }
}