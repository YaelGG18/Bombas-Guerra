<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Refaccion;
use App\Models\VentaDirecta;
use Exception;

class VentaDirectaController extends Controller
{
    // Carga la vista del módulo con las refacciones del inventario
    public function index()
    {
        $refacciones = Refaccion::all();
        return view('venta_directa', compact('refacciones'));
    }

    // Procesa la compra del carrito enviada por JavaScript
    public function procesarVenta(Request $request)
    {
        $productos = $request->input('productos', []);

        if (empty($productos)) {
            return response()->json([
                'success' => false,
                'message' => 'El carrito está vacío.'
            ]);
        }

        try {
            DB::beginTransaction();

            $totalVenta = 0;
            $totalArticulos = 0;

            // Validar stock antes de descontar
            foreach ($productos as $item) {
                $refaccion = Refaccion::find($item['id']);
                
                if (!$refaccion || $refaccion->stock < $item['cantidad']) {
                    throw new Exception("Stock insuficiente para la refacción: " . ($refaccion->nombre ?? 'Desconocida'));
                }

                $totalVenta += ($item['precio'] * $item['cantidad']);
                $totalArticulos += $item['cantidad'];
            }

            // Generar un folio de ticket único
            $folioTicket = 'TICK-' . rand(1000, 9999);

            // Registrar la venta principal
            DB::table('venta_directa')->insert([
                'folioTicket'       => $folioTicket,
                'clienteMostrador'  => 'Público General',
                'cantidadArticulos' => $totalArticulos,
                'total'             => $totalVenta,
                'created_at'        => now()
            ]);

            // Descontar el stock de cada refacción vendida
            foreach ($productos as $item) {
                DB::table('refacciones')
                    ->where('id', $item['id'])
                    ->decrement('stock', $item['cantidad']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '¡Venta procesada con éxito! Folio de Ticket: ' . $folioTicket
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}