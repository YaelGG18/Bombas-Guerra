<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refaccion extends Model
{
    use HasFactory;

    protected $table = 'refacciones';

    protected $fillable = [
        'nombre',
        'categoria',
        'marca',
        'precio_compra',
        'precio_venta',
        'stock',
        'stock_minimo',
        'descripcion',
    ];
}