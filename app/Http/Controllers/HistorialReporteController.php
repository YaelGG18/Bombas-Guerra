<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorialReporteController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio =$request->input('fecha_inicio');
        $fechaFin    =$request->input('fecha_fin');
        $search      =$request->input('search');
        $tabActiva   =$request->input('tab', 'ot');

        // --- 1. CONSULTA DE ÓRDENES DE TRABAJO ---
        $queryOT = DB::table('orden_trabajo')
            ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'orden_trabajo.*',
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($fechaInicio) {
            $queryOT->whereDate('orden_trabajo.fechaCreacion', '>=',$fechaInicio);
        }
        if ($fechaFin) {
            $queryOT->whereDate('orden_trabajo.fechaCreacion', '<=',$fechaFin);
        }
        if ($search) {$queryOT->where(function($q) use ($search) {
                $q->where('orden_trabajo.folioOT', 'LIKE', "\%{$search}%")
                  ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                  ->orWhere('orden_trabajo.diagnosticoFalla', 'LIKE', "%{$search}%");
            });
        }

        $ordenes =$queryOT->orderBy('orden_trabajo.fechaCreacion', 'desc')->get();

        // Calcular totales de refacciones y mano de obra para cada OT
        foreach ($ordenes as $ot) {$detalles = DB::table('detalle_ot')
                ->where('idOT', $ot->idOT)
                ->get();

            $subtotalRefacciones = $detalles->sum(function($item) {
                return $item->cantidad * $item->precioUnitarioHistorico;
            });

            $ot->refaccionesTotal =$subtotalRefacciones;
            $ot->totalGeneral     = $subtotalRefacciones +$ot->costoManoObra;
        }

        // --- 2. CONSULTA DE VENTAS DIRECTAS ---
        // (Nota: Ajusta el nombre de la tabla si en tu BD se llama diferente, ej. 'venta_directa' o 'ventas')
        $ventas = collect();
        try {
            $queryVentas = DB::table('venta_directa');

            if ($fechaInicio) {
                $queryVentas->whereDate('created_at', '>=',$fechaInicio);
            }
            if ($fechaFin) {
                $queryVentas->whereDate('created_at', '<=',$fechaFin);
            }
            if ($search) {$queryVentas->where(function($q) use ($search) {
                    $q->where('folioTicket', 'LIKE', "\%{$search}%")
                      ->orWhere('clienteMostrador', 'LIKE', "%{$search}%");
                });
            }
            $ventas =$queryVentas->orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            // Si la tabla de ventas directas aún tiene otro esquema, la colección se mantiene vacía sin romper la app.
        }

        return view('historial_movimientos', compact('ordenes', 'ventas', 'fechaInicio', 'fechaFin', 'search', 'tabActiva'));
    }
}