<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class GarantiaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // 1. Consultar Garantías registradas con joins
        $query = DB::table('garantia')
            ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.id')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.id')
            ->select(
                'garantia.*', 
                'orden_trabajo.id as idOT', 
                'orden_trabajo.fecha', 
                'cliente.nombre as nombre_cliente',
                'cliente.telefono'
            );

        if ($search) {
            $query->where('garantia.codigo_unico', 'like', "%$search%")
                  ->orWhere('orden_trabajo.id', 'like', "%$search%")
                  ->orWhere('cliente.nombre', 'like', "%$search%");
        }

        $garantias = $query->get();

        // 2. Calcular estadísticas (Vigentes vs Vencidas)
        $totalGarantias = count($garantias);
        $vigentesCount = 0;
        $vencidasCount = 0;

        foreach ($garantias as $gar) {
            $fechaVencimiento = Carbon::parse($gar->fecha)->addDays($gar->vigencia_dias);
            if (Carbon::now()->startOfDay()->lte($fechaVencimiento)) {
                $vigentesCount++;
            } else {
                $vencidasCount++;
            }
        }

        // 3. Órdenes Terminadas disponibles para emitir nueva garantía
        $ordenesTerminadas = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.id')
            ->where('orden_trabajo.estado', 'Terminada') 
            ->whereNotIn('orden_trabajo.id', function($q) {
                $q->select('idOT')->from('garantia'); // Excluir OT que ya tienen garantía
            })
            ->select('orden_trabajo.id as idOT', 'cliente.nombre as nombre_cliente')
            ->get();

        return view('garantias', compact('garantias', 'totalGarantias', 'vigentesCount', 'vencidasCount', 'ordenesTerminadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idOT' => 'required|integer',
            'vigencia_dias' => 'required|integer|min:1'
        ]);

        try {
            DB::table('garantia')->insert([
                'idOT' => $request->input('idOT'),
                'codigo_unico' => 'BG-' . strtoupper(Str::random(5)), // Genera código tipo BG-X8A2B
                'vigencia_dias' => $request->input('vigencia_dias')
            ]);

            return redirect()->route('garantias.index')->with('success', 'Garantía generada exitosamente.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al emitir póliza: ' . $e->getMessage());
        }
    }
}