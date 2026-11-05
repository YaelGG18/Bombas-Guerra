<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_ot', function (Blueprint $table) {
            $table->increments('idDetalleOT');
            
            // CAMBIO: unsignedInteger para que coincida con orden_trabajo
            $table->unsignedInteger('idOT'); 
            $table->unsignedBigInteger('idRefaccion');
            
            $table->integer('cantidad');
            $table->decimal('precioUnitarioHistorico', 10, 2);

            $table->foreign('idOT')->references('idOT')->on('orden_trabajo')->onDelete('cascade');
            $table->foreign('idRefaccion')->references('id')->on('refacciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_ot');
    }
};