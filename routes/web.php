<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RefaccionController;
use App\Http\Controllers\VentaDirectaController;
use App\Http\Controllers\CotizController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\GarantiaController;
use App\Http\Controllers\HistorialReporteController;

// Ruta del Login (Pantalla Principal)
Route::get('/', function () {
    return view('login');
});

// Ruta del Dashboard
Route::get('/barratareas', function () {
    return view('barratareas');
});

// INVENTARIO: Consulta las refacciones guardadas en MySQL
Route::get('/inventario', [RefaccionController::class, 'index']);

// REGISTRAR ENTRADA: Muestra la vista y recibe el formulario
Route::get('/registrar_entrada', function () {
    return view('registrar_entrada');
});
Route::post('/registrar_entrada', [RefaccionController::class, 'store']);

// Demás módulos del taller
Route::get('/cotizaciones', function () {
    return view('cotizaciones');
});

Route::get('/ordenes_trabajo', [OrdenTrabajoController::class, 'index']);
Route::post('/ordenes_trabajo/estado/{id}', [OrdenTrabajoController::class, 'actualizarEstado']);
Route::put('/ordenes_trabajo/{id}', [OrdenTrabajoController::class, 'update']);
Route::post('/ordenes_trabajo/store-directo', [OrdenTrabajoController::class, 'storeDirecto'])->name('ordenes_trabajo.store');



Route::get('/venta_directa', [VentaDirectaController::class, 'index']);
Route::post('/venta_directa/procesar', [VentaDirectaController::class, 'procesarVenta'])->name('venta_directa.procesar');


Route::get('/garantias', [GarantiaController::class, 'index']);
Route::post('/garantias', [GarantiaController::class, 'store'])->name('garantias.store');

Route::get('/historial_movimientos', [HistorialReporteController::class, 'index']);

Route::get('/cotizaciones', function () {
    return view('cotizaciones'); })->name('cotizaciones.index');

Route::put('/refacciones/{id}', [RefaccionController::class, 'update']);

Route::delete('/refacciones/{id}', [RefaccionController::class, 'destroy']);

Route::get('/venta_directa', [RefaccionController::class, 'ventaDirecta'])->name('venta_directa');
Route::post('/venta_directa/procesar', [RefaccionController::class, 'procesarVenta'])->name('venta_directa.procesar');
Route::get('/cotizaciones', [CotizController::class, 'index'])->name('cotizaciones.index');
Route::post('/generar-cotizacion', [CotizController::class, 'generarCotizacion'])->name('cotizacion.generar');



