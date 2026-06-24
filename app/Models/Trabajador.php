<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $primaryKey = 'id_trabajador';

    protected $fillable = [
        'nombre',
        'telefono',
        'puesto',
        'area_asignada',
        'estatus'
    ];
}
