<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class VentaDirectaController extends Controller
{
    public function index()
    {
        return view('venta_directa');
    }

    public function store(Request $request)
    {
        try {
            // Generar folio de venta
            $ultimoRegistro = DB::table('venta_directa')->latest('idVenta')->first();
            $siguienteId = $ultimoRegistro ? $ultimoRegistro->idVenta + 1 : 1;
            $folioGenerado = 'VD-' . str_pad($siguienteId, 4, '0', STR_PAD_LEFT);

            // Guardar en la tabla principal
            DB::table('venta_directa')->insert([
                'folioVenta' => $folioGenerado,
                'idCliente' => $request->input('cliente_id') ?? 1, // Asume cliente 1 si es Mostrador
                'idUsuario' => 1, // Se agrega usuario por defecto para evitar errores
                'fechaVenta' => now()
            ]);

            return redirect()->back()->with('success', 'Venta registrada correctamente. Folio: ' . $folioGenerado);

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar la venta: ' . $e->getMessage());
        }
    }
}