<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenTrabajoController extends Controller
{
    public function index(Request $request)
    {
        // Consulta uniendo la orden con los datos del cliente
        $query = DB::table('orden_trabajo')
            ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'orden_trabajo.*',
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        // Buscador rápido
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('orden_trabajo.folioOT', 'LIKE', "%{$search}%")
                  ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                  ->orWhere('cliente.telefono', 'LIKE', "%{$search}%")
                  ->orWhere('orden_trabajo.diagnosticoFalla', 'LIKE', "%{$search}%");
            });
        }

        $ordenes = $query->orderBy('orden_trabajo.fechaCreacion', 'desc')->get();

        // Contadores para las tarjetas superiores
        $totalOrdenes = DB::table('orden_trabajo')->count();
        $enProceso    = DB::table('orden_trabajo')->where('estadoOT', 'En Proceso')->count();
        $terminado    = DB::table('orden_trabajo')->where('estadoOT', 'Terminado')->count();
        $cancelado    = DB::table('orden_trabajo')->where('estadoOT', 'Cancelado')->count();

        return view('ordenes_trabajo', compact('ordenes', 'totalOrdenes', 'enProceso', 'terminado', 'cancelado'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        DB::table('orden_trabajo')
            ->where('idOT', $id)
            ->update(['estadoOT' => $request->estadoOT]);

        return back()->with('success', 'Estado de la orden actualizado correctamente.');
    }
}