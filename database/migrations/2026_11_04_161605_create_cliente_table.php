<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('idCliente');
            $table->string('nombreCliente', 150);
            $table->string('telefono', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};