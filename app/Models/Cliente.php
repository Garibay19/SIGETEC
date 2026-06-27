<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Le indicamos el nombre exacto de la tabla en MySQL
    protected $table = 'clientes';

    // Definimos la llave primaria de la tabla
    protected $primaryKey = 'id_cliente';

    // AUTORIZACIÓN: Permitimos que el buscador inteligente cree clientes usando el nombre libre
    protected $fillable = [
       'nombre_completo',
        'telefono',
        'correo',
        'direccion',
        'observaciones' // Campo nuevo autorizado
    ];

    // Relación: Un cliente puede tener múltiples pedidos
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente', 'id_cliente');
    }
}
