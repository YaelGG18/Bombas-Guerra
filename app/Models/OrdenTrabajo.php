<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = 'orden_trabajo';
    protected $primaryKey = 'idOT';
    public $timestamps = false;

    protected $fillable = [
        'folioOT',
        'idCliente',
        'diagnosticoFalla',
        'costoManoObra',
        'estadoOT',
        'fechaCreacion'
    ];
}