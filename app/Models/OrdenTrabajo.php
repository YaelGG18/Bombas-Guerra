<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'ordentrabajo';
    
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'idCliente', 
        'falla', 
        'manoObra', 
        'estado', 
        'fecha'
    ];

    // Relación con los detalles (1 a muchos)
    public function detalles()
    {
        return $this->hasMany(DetalleOT::class, 'idOT');
    }
}