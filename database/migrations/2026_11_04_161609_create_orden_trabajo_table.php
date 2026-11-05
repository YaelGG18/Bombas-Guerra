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
            
            $table->unsignedInteger('idCliente');
            $table->unsignedInteger('idUsuario')->nullable(); // Coincide exactamente con el increments de usuario

            $table->text('diagnosticoFalla');
            $table->decimal('costoManoObra', 10, 2);
            $table->string('estadoOT', 50)->nullable()->default('En Proceso');
            $table->datetime('fechaCreacion');

            // Llaves foráneas
            $table->foreign('idCliente')->references('idCliente')->on('cliente')->onDelete('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_trabajo');
    }
};