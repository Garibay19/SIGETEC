<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    use HasFactory;

    protected $table = 'prendas';
    protected $primaryKey = 'id_prenda';

    protected $fillable = [
        'nombre_prenda',
        'categoria',
        'talla',
        'stock_disponible',
        'imagen', // Añadido
        'estatus'
    ];
}
