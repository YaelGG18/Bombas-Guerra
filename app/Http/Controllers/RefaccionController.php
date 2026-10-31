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
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'required|string',
            'marca'         => 'required|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'cantidad'      => 'required|integer|min:1',
            'stock_minimo'  => 'required|integer|min:0',
        ]);

        Refaccion::create([
            'nombre'        => $request->input('nombre'),
            'categoria'     => $request->input('categoria'),
            'marca'         => $request->input('marca'),
            'precio_compra' => $request->input('precio_compra'),
            'precio_venta'  => $request->input('precio_venta'),
            'stock'         => $request->input('cantidad'),
            'stock_minimo'  => $request->input('stock_minimo'),
            'descripcion'   => $request->input('descripcion'),
        ]);

        return redirect('/inventario')->with('exito', 'Refacción registrada correctamente.');
    }
    // Actualizar datos de la refacción
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'categoria'     => 'required|string',
            'marca'         => 'required|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'cantidad'      => 'required|integer|min:0',
            'stock_minimo'  => 'required|integer|min:0',
        ]);

        $refaccion = Refaccion::findOrFail($id);
        $refaccion->update([
            'nombre'        => $request->input('nombre'),
            'categoria'     => $request->input('categoria'),
            'marca'         => $request->input('marca'),
            'precio_compra' => $request->input('precio_compra'),
            'precio_venta'  => $request->input('precio_venta'),
            'stock'         => $request->input('cantidad'),
            'stock_minimo'  => $request->input('stock_minimo'),
            'descripcion'   => $request->input('descripcion'),
        ]);

        return redirect('/inventario')->with('exito', 'Refacción actualizada correctamente.');
    }

    // Eliminar refacción
    public function destroy($id)
    {
        $refaccion = Refaccion::findOrFail($id);
        $refaccion->delete();

        return redirect('/inventario')->with('exito', 'Refacción eliminada.');
    }
}