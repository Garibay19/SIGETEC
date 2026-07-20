<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_cliente',
        'descripcion',
        'fecha_pedido',
        'fecha_entrega',
        'total',
        'saldo_pendiente',
        'estado'
    ];

    // Relación nativa para traer los datos del cliente de forma automática
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}
