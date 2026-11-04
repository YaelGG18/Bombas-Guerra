<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDirecta extends Model
{
    use HasFactory;

    protected $table = 'venta_directa';
    protected $primaryKey = 'idVenta';
    public $timestamps = false; // O true si prefieres manejar created_at automáticamente

    protected $fillable = [
        'folioTicket',
        'clienteMostrador',
        'cantidadArticulos',
        'total',
        'created_at'
    ];
}