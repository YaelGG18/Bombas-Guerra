<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;

class GarantiaController extends Controller
{
    // 1. Cargar la vista principal con las tablas y estadísticas
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consultar Garantías registradas (Corregido a orden_trabajo.idOT)
        $query = DB::table('garantia')
            ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.idOT')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.id')
            ->select(
                'garantia.*', 
                'orden_trabajo.idOT as idOT', 
                'orden_trabajo.fecha', 
                'cliente.nombre as nombre_cliente',
                'cliente.telefono'
            );

        if ($search) {
            $query->where('garantia.codigo_unico', 'like', "%$search%")
                  ->orWhere('orden_trabajo.idOT', 'like', "%$search%")
                  ->orWhere('cliente.nombre', 'like', "%$search%");
        }

        $garantias = $query->get();

        // Calcular estadísticas (Vigentes vs Vencidas)
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

        // Órdenes Terminadas disponibles para emitir nueva garantía (Corregido a orden_trabajo.idOT)
        $ordenesTerminadas = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.id')
            ->where('orden_trabajo.estado', 'Terminada') 
            ->whereNotIn('orden_trabajo.idOT', function($q) {
                $q->select('idOT')->from('garantia'); 
            })
            ->select('orden_trabajo.idOT as idOT', 'cliente.nombre as nombre_cliente')
            ->get();

        return view('garantias', compact('garantias', 'totalGarantias', 'vigentesCount', 'vencidasCount', 'ordenesTerminadas'));
    }

    // 2. Crear nueva garantía en la BD
    public function store(Request $request)
    {
        $request->validate([
            'idOT' => 'required|integer',
            'vigencia_dias' => 'required|integer|min:1'
        ]);

        try {
            DB::table('garantia')->insert([
                'idOT' => $request->input('idOT'),
                'codigo_unico' => 'BG-' . strtoupper(Str::random(5)), 
                'vigencia_dias' => $request->input('vigencia_dias')
            ]);

            return redirect()->route('garantias.index')->with('success', 'Garantía generada exitosamente.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al emitir póliza: ' . $e->getMessage());
        }
    }

    // 3. Buscar código único de validación (Desde la barra de búsqueda de la vista principal)
    public function buscar(Request $request)
    {
        $request->validate([
            'codigo_garantia' => 'required|string|max:50'
        ], [
            'codigo_garantia.required' => 'Debe ingresar un código para buscar.'
        ]);

        $codigo = $request->input('codigo_garantia');

        try {
            // (Corregido a orden_trabajo.idOT)
            $resultado = DB::table('garantia')
                ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.idOT')
                ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.id')
                ->where('garantia.codigo_unico', $codigo)
                ->select(
                    'garantia.*', 
                    'orden_trabajo.falla',
                    'orden_trabajo.fecha as fecha_reparacion',
                    'cliente.nombre as nombre_cliente'
                )
                ->first();

            if ($resultado) {
                return view('garantias', compact('resultado'));
            } else {
                return redirect()->back()->with('error', 'Código de garantía "' . $codigo . '" no encontrado o no es válido.');
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error del sistema: ' . $e->getMessage());
        }
    }
}