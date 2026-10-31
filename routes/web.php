<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RefaccionController;

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

Route::get('/ordenes_trabajo', function () {
    return view('ordenes_trabajo');
});

Route::get('/venta_directa', function () {
    return view('venta_directa');
});

Route::get('/garantias', function () {
    return view('garantias');
});

Route::get('/historial_movimientos', function () {
    return view('historial_movimientos');
});

Route::put('/refacciones/{id}', [RefaccionController::class, 'update']);

Route::delete('/refacciones/{id}', [RefaccionController::class, 'destroy']);