<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class GarantiaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            $garantias = collect();
        } else {
            $garantias = DB::table('garantia')
                ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.idOT')
                ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
                ->select(
                    'garantia.*',
                    'orden_trabajo.folioOT',
                    'cliente.nombreCliente',
                    'cliente.telefono'
                )
                ->where(function($q) use ($search) {
                    $q->where('garantia.codigoVerificacion', 'LIKE', "%{$search}%")
                      ->orWhere('orden_trabajo.folioOT', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.telefono', 'LIKE', "%{$search}%");
                })
                ->orderBy('garantia.fechalinicio', 'desc')
                ->get();
        }

        // Órdenes terminadas disponibles para asignarles garantía
        $ordenesTerminadas = DB::table('orden_trabajo')
            ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select('orden_trabajo.idOT', 'orden_trabajo.folioOT', 'cliente.nombreCliente')
            ->where('orden_trabajo.estadoOT', 'Terminado')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('garantia')
                      ->whereRaw('garantia.idOT = orden_trabajo.idOT');
            })
            ->get();

        $totalGarantias = DB::table('garantia')->count();
        $vigentes       = DB::table('garantia')->where('estadoGarantia', 'Vigente')->count();

        return view('garantias', compact('garantias', 'ordenesTerminadas', 'totalGarantias', 'vigentes', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idOT'         => 'required|integer',
            'vigenciaDias' => 'required|integer|min:1'
        ]);

        // Verificar que la OT esté realmente en estado 'Terminado'
        $ot = DB::table('orden_trabajo')->where('idOT', $request->idOT)->first();

        if (!$ot || $ot->estadoOT !== 'Terminado') {
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