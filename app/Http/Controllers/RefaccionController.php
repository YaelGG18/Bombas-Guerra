<?php

namespace App\Http\Controllers;

use App\Models\Refaccion;
use Illuminate\Http\Request;

class RefaccionController extends Controller
{
    // 1. Muestra la vista de Inventario trayendo las refacciones registradas
    public function index()
    {
        $refacciones = Refaccion::all();
        return view('inventario', compact('refacciones'));
    }

    // 2. Procesa el formulario de Registrar Entrada y guarda en la BD
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'marca' => 'required|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:1',
            'stock_minimo' => 'required|integer|min:0',
        ]);

        Refaccion::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'marca' => $request->marca,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'stock' => $request->cantidad,
            'stock_minimo' => $request->stock_minimo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/inventario')->with('exito', 'Refacción registrada correctamente.');
    }
}