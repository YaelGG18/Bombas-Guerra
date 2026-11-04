<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class GarantiaController extends Controller
{
    // Muestra la vista inicial con el buscador vacío
    public function index()
    {
        return view('garantias'); 
    }

    // Procesa la búsqueda del código de garantía
    public function buscar(Request $request)
    {
        // 1. Validar que el usuario escribió algo
        $request->validate([
            'codigo_garantia' => 'required|string|max:50'
        ], [
            'codigo_garantia.required' => 'Debe ingresar un código para buscar.'
        ]);

        $codigo = $request->input('codigo_garantia');

        try {
            // 2. Consulta a la base de datos usando las tablas reales de tu imagen
            $resultado = DB::table('garantia') // Tu tabla en BD se llama "garantia" (singular)
                ->join('orden_trabajo', 'garantia.idOT', '=', 'orden_trabajo.id') // Tabla "orden_trabajo"
                ->leftJoin('cliente', 'orden_trabajo.idCliente', '=', 'cliente.id') // Tabla "cliente"
                ->where('garantia.codigo_unico', $codigo) // *Verifica que tu columna se llame 'codigo_unico'
                ->select(
                    'garantia.*', 
                    'orden_trabajo.falla',
                    'orden_trabajo.fecha as fecha_reparacion',
                    'cliente.nombre as nombre_cliente' // Traemos el nombre del cliente
                )
                ->first();

            // 3. Evaluar si existe
            if ($resultado) {
                // Si la encuentra, recarga la vista pasándole los datos de la garantía
                return view('garantias', compact('resultado'));
            } else {
                // Si no existe, retorna a la pantalla anterior con un mensaje de error
                return redirect()->back()->with('error', 'Código de garantía "' . $codigo . '" no encontrado o no es válido.');
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error del sistema: ' . $e->getMessage());
        }
    }
}