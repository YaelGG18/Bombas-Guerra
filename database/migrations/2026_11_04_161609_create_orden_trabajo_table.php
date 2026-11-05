<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orden_trabajo', function (Blueprint $table) {
            $table->increments('idOT');
            $table->string('folioOT', 50)->unique();
            $table->integer('idCliente');
            $table->integer('idUsuario')->nullable(); // Permite nulos según BaseFinal
            $table->text('diagnosticoFalla');
            $table->decimal('costoManoObra', 10, 2);
            $table->string('estadoOT', 50)->nullable()->default('En Proceso');
            $table->datetime('fechaCreacion');

            $table->foreign('idCliente')->references('idCliente')->on('cliente');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_trabajo');
    }
};