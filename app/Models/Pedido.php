<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // Le indicamos el nombre exacto de la tabla en MySQL
    protected $table = 'pedidos';

    // Definimos la llave primaria de la tabla
    protected $primaryKey = 'id_pedido';

    // AUTORIZACIÓN: Permitimos que estos campos guarden datos masivos de los formularios
    protected $fillable = [
       'id_cliente',
        'fecha_pedido', // Campo nuevo agregado
        'descripcion',
        'fecha_entrega',
        'total',
        'saldo_pendiente',
        'estado'
    ];

    // Relación relacional: Un pedido pertenece a un cliente específico
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
