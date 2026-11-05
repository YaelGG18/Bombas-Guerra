<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venta_directa', function (Blueprint $table) {
            $table->increments('idVenta');
            $table->string('folioVenta', 50)->unique();
            
            // CAMBIOS: unsignedInteger
            $table->unsignedInteger('idCliente');
            $table->unsignedInteger('idUsuario')->nullable(); 
            
            $table->datetime('fechaVenta');

            $table->foreign('idCliente')->references('idCliente')->on('cliente')->onDelete('cascade');
            $table->foreign('idUsuario')->references('idUsuario')->on('usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venta_directa');
    }
};