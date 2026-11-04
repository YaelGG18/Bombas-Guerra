<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    use HasFactory;

    // Nombre exacto de tu tabla en la BD
    protected $table = 'ordentrabajo';
    
    // Desactivar timestamps si tu tabla no tiene created_at y updated_at
    public $timestamps = false; 
    
    protected $fillable = [
        'idCliente', 
        'falla', 
        'manoObra', 
        'estado', 
        'fecha'
    ];
}