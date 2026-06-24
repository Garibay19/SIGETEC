<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bono extends Model
{
    // Nombre exacto de la tabla en tu base de datos
    protected $table = 'bonos';
    
    // Llave primaria corregida
    protected $primaryKey = 'id_bono';

    // Campos autorizados para la captura semanal tipo Excel
    protected $fillable = [
        'id_trabajador',
        'operacion',
        'objetivo_semanal',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'total_piezas',
        'monto_bono',
        'cumplimiento'
    ];

    // Relación relacional con el personal del taller
    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'id_trabajador', 'id_trabajador');
    }
}
