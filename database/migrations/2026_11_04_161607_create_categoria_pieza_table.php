<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categoria_pieza', function (Blueprint $table) {
            $table->id('idCategoria');
            $table->string('nombreCategoria', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria_pieza');
    }
};