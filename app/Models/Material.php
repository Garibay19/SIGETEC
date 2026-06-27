<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';
    protected $primaryKey = 'id_material';

    protected $fillable = [
        'nombre_material',
        'categoria',
        'stock',
        'stock_danado', // Campo de merma autorizado
        'unidad_medida',
        'costo_unitario',
        'proveedor',
        'fecha_compra'
    ];
}
