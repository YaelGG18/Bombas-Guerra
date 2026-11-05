<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('garantia', function (Blueprint $table) {
            $table->increments('idGarantia');
            
            // CAMBIO: unsignedInteger
            $table->unsignedInteger('idOT'); 
            
            $table->string('codigoVerificacion', 50);
            $table->date('fechalinicio');
            $table->integer('vigenciaDias');
            $table->string('estadoGarantia', 50)->nullable()->default('Vigente');

            $table->foreign('idOT')->references('idOT')->on('orden_trabajo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garantia');
    }
};