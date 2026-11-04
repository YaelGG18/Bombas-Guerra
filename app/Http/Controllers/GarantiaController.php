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

        // Consultar Garantías registradas con los nombres exactos de columnas de la BD
        $query = DB::table('garantia')
            ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.idOT')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            ->select(
                'garantia.*', 
                'orden_trabajo.folioOT', 
                'cliente.nombreCliente',
                'cliente.telefono'
            );

        if ($search) {
            $query->where('garantia.codigoVerificacion', 'like', "%$search%")
                  ->orWhere('orden_trabajo.folioOT', 'like', "%$search%")
                  ->orWhere('cliente.nombreCliente', 'like', "%$search%");
        }

        $garantias = $query->get();

        // Calcular estadísticas (Vigentes vs Vencidas)
        $totalGarantias = count($garantias);
        $vigentesCount = 0;
        $vencidasCount = 0;

        foreach ($garantias as $gar) {
            // Usamos fechalinicio y vigenciaDias reales de la tabla garantia
            $fechaVencimiento = Carbon::parse($gar->fechalinicio)->addDays($gar->vigenciaDias);
            if (Carbon::now()->startOfDay()->lte($fechaVencimiento)) {
                $vigentesCount++;
            } else {
                $vencidasCount++;
            }
        }

        // Órdenes Terminadas disponibles para emitir nueva garantía
        $ordenesTerminadas = DB::table('orden_trabajo')
            ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
            // Ampliamos el filtro para aceptar diferentes variaciones de estado final
            ->whereIn('orden_trabajo.estadoOT', ['Terminada', 'Finalizada', 'Entregada'])
            ->whereNotIn('orden_trabajo.idOT', function($q) {
                $q->select('idOT')->from('garantia'); 
            })
            ->select('orden_trabajo.idOT', 'orden_trabajo.folioOT', 'cliente.nombreCliente')
            ->get();

        return view('garantias', compact('garantias', 'totalGarantias', 'vigentesCount', 'vencidasCount', 'ordenesTerminadas'));
    }

    // 2. Crear nueva garantía en la BD
    public function store(Request $request)
    {
        $request->validate([
            'idOT' => 'required|integer',
            'vigenciaDias' => 'required|integer|min:1'
        ]);

        try {
            DB::table('garantia')->insert([
                'idOT' => $request->input('idOT'),
                'codigoVerificacion' => 'BG-' . strtoupper(Str::random(5)), 
                'fechalinicio' => Carbon::now()->toDateString(), // Asigna la fecha actual
                'vigenciaDias' => $request->input('vigenciaDias'),
                'estadoGarantia' => 'Vigente'
            ]);

            return redirect()->route('garantias.index')->with('success', 'Garantía generada exitosamente.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al emitir póliza: ' . $e->getMessage());
        }
    }

    // 3. Buscar código único de validación
    public function buscar(Request $request)
    {
        $request->validate([
            'codigo_garantia' => 'required|string|max:50'
        ], [
            'codigo_garantia.required' => 'Debe ingresar un código para buscar.'
        ]);

        $codigo = $request->input('codigo_garantia');

        try {
            $resultado = DB::table('garantia')
                ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.idOT')
                ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
                ->where('garantia.codigoVerificacion', $codigo)
                ->select(
                    'garantia.*', 
                    'orden_trabajo.diagnosticoFalla', 
                    'orden_trabajo.folioOT', 
                    'cliente.nombreCliente'
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