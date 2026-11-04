<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class VentaDirectaController extends Controller
{
    public function index()
    {
        // Esto envía las refacciones a la vista para que el catálogo no esté vacío
        $refacciones = DB::table('refacciones')->where('stock', '>', 0)->get();
        return view('venta_directa', compact('refacciones'));
    }

    // Este es el método que recibe el JSON desde Javascript
    public function procesarVenta(Request $request)
    {
        $productos = $request->input('productos');

        if (empty($productos)) {
            return response()->json(['success' => false, 'message' => 'El carrito está vacío.']);
        }

        try {
            DB::beginTransaction();

            // 1. Generar folio
            $ultimoRegistro = DB::table('venta_directa')->latest('idVenta')->first();
            $siguienteId = $ultimoRegistro ? $ultimoRegistro->idVenta + 1 : 1;
            $folioGenerado = 'VD-' . str_pad($siguienteId, 4, '0', STR_PAD_LEFT);

            // 2. Insertar Venta Directa (Con idUsuario=1 por defecto para evitar errores)
            $idVenta = DB::table('venta_directa')->insertGetId([
                'folioVenta' => $folioGenerado,
                'idCliente' => 1, // Por defecto al cliente de mostrador (ID 1)
                'idUsuario' => 1, // Usuario por defecto
                'fechaVenta' => now()
            ]);

            // 3. Insertar detalles y descontar inventario
            foreach ($productos as $prod) {
                // Aquí deberías tener una tabla 'detalle_venta' en tu BD
                // Si aún no la tienes, esta parte del código está lista para cuando la crees
                /*
                DB::table('detalle_venta')->insert([
                    'idVenta' => $idVenta,
                    'idRefaccion' => $prod['id'],
                    'cantidad' => $prod['cantidad'],
                    'precioUnitario' => $prod['precio']
                ]);
                */

                // Descontar inventario real
                DB::table('refacciones')
                    ->where('id', $prod['id'])
                    ->decrement('stock', $prod['cantidad']);
            }

            DB::commit();

            return response()->json([
                'success' => true, 
                'message' => 'Venta finalizada correctamente. Folio: ' . $folioGenerado
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error de BD: ' . $e->getMessage()]);
        }
    }
}