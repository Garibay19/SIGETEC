<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $table = 'maquinarias';
    protected $primaryKey = 'id_maquinaria';

    protected $fillable = [
        'nombre_maquina',
        'marca',
        'modelo',
        'estatus',
        'fecha_adquisicion'
    ];
}
