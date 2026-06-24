<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'id_pedido',
        'fecha_pago',
        'monto_total_pedido',
        'abono',
        'saldo_restante',
        'metodo_pago',
        'estado'
    ];

    // Relación: Un pago pertenece obligatoriamente a un pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }
}
