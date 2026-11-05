<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->increments('idDetalleVenta');
            
            // CAMBIO: unsignedInteger
            $table->unsignedInteger('idVenta'); 
            $table->unsignedBigInteger('idRefaccion');
            
            $table->integer('cantidad');
            $table->decimal('precioUnitario', 10, 2);

            $table->foreign('idVenta')->references('idVenta')->on('venta_directa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
    }
};