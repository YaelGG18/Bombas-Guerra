<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Refaccion;
use Exception;

class OrdenTrabajoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!$search) {
            $ordenes = collect();
        } else {
            $ordenes = DB::table('orden_trabajo')
                ->join('cliente', 'orden_trabajo.idCliente', '=', 'cliente.idCliente')
                ->select(
                    'orden_trabajo.*',
                    'cliente.nombreCliente',
                    'cliente.telefono'
                )
                ->where(function($q) use ($search) {
                    $q->where('orden_trabajo.folioOT', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.nombreCliente', 'LIKE', "%{$search}%")
                      ->orWhere('cliente.telefono', 'LIKE', "%{$search}%")
                      ->orWhere('orden_trabajo.diagnosticoFalla', 'LIKE', "%{$search}%");
                })
                ->orderBy('orden_trabajo.fechaCreacion', 'desc')
                ->get();
        }

        foreach ($ordenes as $ot) {
            $ot->refacciones = DB::table('detalle_ot')
                ->join('refacciones', 'detalle_ot.idRefaccion', '=', 'refacciones.id')
                ->select('detalle_ot.*', 'refacciones.nombre', 'refacciones.precio_venta as precio', 'refacciones.stock as stockMax')
                ->where('detalle_ot.idOT', $ot->idOT)
                ->get();

            $subtotalRefacciones = $ot->refacciones->sum(function($item) {
                return $item->cantidad * $item->precioUnitarioHistorico;
            });

            $ot->totalGeneral = $subtotalRefacciones + $ot->costoManoObra;
        }

        $totalOrdenes = DB::table('orden_trabajo')->count();
        $enProceso    = DB::table('orden_trabajo')->where('estadoOT', 'En Proceso')->count();
        $terminado    = DB::table('orden_trabajo')->where('estadoOT', 'Terminado')->count();
        $cancelado    = DB::table('orden_trabajo')->where('estadoOT', 'Cancelado')->count();

        $refacciones = Refaccion::all();

        return view('ordenes_trabajo', compact('ordenes', 'totalOrdenes', 'enProceso', 'terminado', 'cancelado', 'refacciones', 'search'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        DB::table('orden_trabajo')
            ->where('idOT', $id)
            ->update(['estadoOT' => $request->estadoOT]);

        return back()->with('success', 'Estado de la orden actualizado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $ordenActual = DB::table('orden_trabajo')->where('idOT', $id)->first();
        if ($ordenActual && $ordenActual->estadoOT === 'Terminado') {
            return back()->with('error', 'Esta Orden de Trabajo ya se encuentra Terminada y cuenta con garantía asignada. No se puede modificar.');
        }

        $request->validate([
            'diagnosticoFalla' => 'required|string',
            'costoManoObra'    => 'required|numeric|min:0',
            'estadoOT'         => 'required|string'
        ]);

        $manoObra = floatval($request->input('costoManoObra'));
        $refaccionesStr = $request->input('refacciones', '[]');
        $refacciones = is_string($refaccionesStr) ? json_decode($refaccionesStr, true) : $refaccionesStr;

        try {
            DB::beginTransaction();

            DB::table('orden_trabajo')
                ->where('idOT', $id)
                ->update([
                    'diagnosticoFalla' => $request->input('diagnosticoFalla'),
                    'costoManoObra'    => $manoObra,
                    'estadoOT'         => $request->input('estadoOT')
                ]);

            $detallesAntiguos = DB::table('detalle_ot')->where('idOT', $id)->get();
            foreach ($detallesAntiguos as $antiguo) {
                DB::table('refacciones')
                    ->where('id', $antiguo->idRefaccion)
                    ->increment('stock', $antiguo->cantidad);
            }

            DB::table('detalle_ot')->where('idOT', $id)->delete();

            if (is_array($refacciones) && count($refacciones) > 0) {
                $nuevosDetalles = [];
                foreach ($refacciones as $item) {
                    $nuevosDetalles[] = [
                        'idOT'                    => $id,
                        'idRefaccion'             => $item['id_refaccion'],
                        'cantidad'                => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'],
                    ];

                    DB::table('refacciones')
                        ->where('id', $item['id_refaccion'])
                        ->decrement('stock', $item['cantidad']);
                }
                DB::table('detalle_ot')->insert($nuevosDetalles);
            }

            DB::commit();

            return redirect('/ordenes_trabajo')->with('success', 'Orden de trabajo modificada correctamente.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    public function storeDirecto(Request $request)
    {
        $request->validate([
            'nombreCliente'    => 'required|string|max:150',
            'telefono'         => 'required|string|max:20',
            'diagnosticoFalla' => 'required|string',
            'costoManoObra'    => 'required|numeric|min:0'
        ]);

        $manoObra = floatval($request->input('costoManoObra'));
        $refaccionesStr = $request->input('refacciones', '[]');
        $refacciones = is_string($refaccionesStr) ? json_decode($refaccionesStr, true) : $refaccionesStr;

        try {
            DB::beginTransaction();

            $clienteExistente = DB::table('cliente')->where('telefono', $request->input('telefono'))->first();
            if ($clienteExistente) {
                $idCliente = $clienteExistente->idCliente;
                DB::table('cliente')->where('idCliente', $idCliente)->update(['nombreCliente' => $request->input('nombreCliente')]);
            } else {
                $idCliente = DB::table('cliente')->insertGetId([
                    'nombreCliente' => $request->input('nombreCliente'),
                    'telefono'      => $request->input('telefono')
                ]);
            }

            $folioOT = 'OT-' . rand(1000, 9999);

            // Se elimina 'idUsuario' para evitar el error de columna desconocida
            $idOT = DB::table('orden_trabajo')->insertGetId([
                'folioOT'          => $folioOT,
                'idCliente'        => $idCliente,
                'diagnosticoFalla' => $request->input('diagnosticoFalla'),
                'costoManoObra'    => $manoObra,
                'estadoOT'         => 'En Proceso',
                'fechaCreacion'    => now()
            ]);

            if (is_array($refacciones) && count($refacciones) > 0) {
                $detalles = [];
                foreach ($refacciones as $item) {
                    $detalles[] = [
                        'idOT'                    => $idOT,
                        'idRefaccion'             => $item['id_refaccion'],
                        'cantidad'                => $item['cantidad'],
                        'precioUnitarioHistorico' => $item['precio'],
                    ];

                    DB::table('refacciones')
                        ->where('id', $item['id_refaccion'])
                        ->decrement('stock', $item['cantidad']);
                }
                DB::table('detalle_ot')->insert($detalles);
            }

            DB::commit();

            return redirect('/ordenes_trabajo?search=' . $folioOT)->with('success', '¡Orden creada con éxito! Folio: ' . $folioOT);

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear la orden: ' . $e->getMessage());
        }
    }
}