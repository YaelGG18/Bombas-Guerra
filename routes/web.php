<?php

use Illuminate\Support\Facades\Route;

// Ruta del Login (Pantalla Principal)
Route::get('/', function () {
    return view('login');
});

// Ruta del Dashboard
Route::get('/barratareas', function () {
    return view('barratareas');
});

Route::get('/inventario', function () {
    return view('inventario');
});

Route::get('/registrar_entrada', function () {
    return view('registrar_entrada');
});

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