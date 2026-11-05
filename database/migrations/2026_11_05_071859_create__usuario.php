<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('idUsuario'); // Esto es INT UNSIGNED
            $table->string('contrasenaHash', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};