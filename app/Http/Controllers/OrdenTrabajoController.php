<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenTrabajoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Si no hay búsqueda, la lista nace vacía como lo solicitaste
        if (!$search) {
            $ordenes = collect(); // Colección vacía
        } else {
            $ordenes = DB::table('orden_trabajo')
                ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
                ->select(
                    'orden_trabajo.*',
                    'cliente.nombreCliente',
                    'cliente.telefono'
                )
                ->where(function($q) use ($search) {
                    $q->where('orden_trabajo.folioOT', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.telefono', 'LIKE', "%{$search}%")
                      ->orWhere('orden_trabajo.diagnosticoFalla', 'LIKE', "%{$search}%");
                })
                ->orderBy('orden_trabajo.fechaCreacion', 'desc')
                ->get();
        }

        // Contadores generales
        $totalOrdenes = DB::table('orden_trabajo')->count();
        $enProceso    = DB::table('orden_trabajo')->where('estadoOT', 'En Proceso')->count();
        $terminado    = DB::table('orden_trabajo')->where('estadoOT', 'Terminado')->count();
        $cancelado    = DB::table('orden_trabajo')->where('estadoOT', 'Cancelado')->count();

        return view('ordenes_trabajo', compact('ordenes', 'totalOrdenes', 'enProceso', 'terminado', 'cancelado', 'search'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        DB::table('orden_trabajo')
            ->where('idOT', $id)
            ->update(['estadoOT' => $request->estadoOT]);

        return back()->with('success', 'Estado de la orden actualizado correctamente.');
    }
}