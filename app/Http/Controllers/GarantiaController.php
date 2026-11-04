<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class GarantiaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $otParam = $request->input('ot');

        if (!$search && !$otParam) {
            $garantias = collect();
        } else {
            $query = DB::table('garantia')
                ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.idOT')
                ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
                ->select(
                    'garantia.*',
                    'orden_trabajo.folioOT',
                    'cliente.nombreCliente',
                    'cliente.telefono'
                );

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('garantia.codigoVerificacion', 'LIKE', "%{$search}%")
                      ->orWhere('orden_trabajo.folioOT', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.telefono', 'LIKE', "%{$search}%");
                });
            }

            $garantias = $query->orderBy('garantia.fechalinicio', 'desc')->get();
        }

        $hoy = Carbon::now();
        $todasGarantias = DB::table('garantia')->get();
        
        $vigentesCount = 0;
        $vencidasCount = 0;

        foreach ($todasGarantias as $g) {
            $fechaInicio = Carbon::parse($g->fechalinicio);
            $fechaVencimiento = $fechaInicio->copy()->addDays($g->vigenciaDias);

            if ($hoy->greaterThan($fechaVencimiento)) {
                $vencidasCount++;
                if ($g->estadoGarantia === 'Vigente') {
                    DB::table('garantia')->where('idGarantia', $g->idGarantia)->update(['estadoGarantia' => 'Vencida']);
                }
            } else {
                $vigentesCount++;
            }
        }

        $totalGarantias = DB::table('garantia')->count();

        // Órdenes terminadas o la específica que venga por la URL (?ot=X)
        $ordenesTerminadas = DB::table('orden_trabajo')
            ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select('orden_trabajo.idOT', 'orden_trabajo.folioOT', 'cliente.nombreCliente')
            ->where(function($query) use ($otParam) {
                $query->where('orden_trabajo.estadoOT', 'Terminado')
                      ->orWhere('orden_trabajo.estadoOT', 'terminado');
                if ($otParam) {
                    $query->orWhere('orden_trabajo.idOT', $otParam);
                }
            })
            ->get();

        return view('garantias', compact('garantias', 'ordenesTerminadas', 'totalGarantias', 'vigentesCount', 'vencidasCount', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idOT'         => 'required|integer',
            'vigenciaDias' => 'required|integer|min:1'
        ]);

        $ot = DB::table('orden_trabajo')->where('idOT', $request->idOT)->first();

        if (!$ot || (strtolower($ot->estadoOT) !== 'terminado')) {
            return back()->with('error', 'Solo se puede emitir garantía a Órdenes de Trabajo que se encuentren en estado Terminado.');
        }

        try {
            $codigoVerificacion = 'GAR-' . str_replace('OT-', '', $ot->folioOT) . '-' . rand(100, 999);

            DB::table('garantia')->insert([
                'idOT'               => $request->idOT,
                'codigoVerificacion' => $codigoVerificacion,
                'fechalinicio'       => now()->toDateString(),
                'vigenciaDias'       => $request->vigenciaDias,
                'estadoGarantia'     => 'Vigente'
            ]);

            return redirect('/garantias?search=' . $codigoVerificacion)->with('success', '¡Garantía registrada con éxito! Código: ' . $codigoVerificacion);

        } catch (Exception $e) {
            return back()->with('error', 'Error al registrar la garantía: ' . $e->getMessage());
        }
    }
}