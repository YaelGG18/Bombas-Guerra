<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatosPorDefectoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insertar el cliente de mostrador por defecto
        DB::table('cliente')->insert([
            'idCliente'     => 1,
            'nombreCliente' => 'Cliente Mostrador',
            'telefono'      => '0000000000'
        ]);

        // 2. Insertar el usuario administrador genérico
        DB::table('usuario')->insert([
            'idUsuario'      => 1,
            'contrasenaHash' => 'admin123'
        ]);
    }
}