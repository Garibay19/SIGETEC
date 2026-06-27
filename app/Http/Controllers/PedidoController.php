<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos del formulario de pedidos
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'fecha_pedido' => 'required|date',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'required|date',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|string|max:50',
        ]);

        // 2. BUSCADOR INTELIGENTE PROTEGIDO: Busca si ya existe el cliente por su nombre completo.
        // Si no existe, lo da de alta inyectando valores por defecto en los campos obligatorios del Frontend.
        $cliente = Cliente::firstOrCreate(
            ['nombre_completo' => $request->nombre_cliente],
            [
                'telefono' => 'N/A',
                'correo' => 'sin_correo@ejemplo.com',
                'direccion' => 'Dirección pendiente',
                'observaciones' => 'Registrado automáticamente desde el módulo de pedidos.'
            ]
        );

        // 3. Registramos el pedido vinculando el ID del cliente encontrado o recién creado
        Pedido::create([
            'id_cliente' => $cliente->id_cliente,
            'fecha_pedido' => $request->fecha_pedido,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'total' => $request->total,
            'saldo_pendiente' => $request->total, 
            'estado' => $request->estado
        ]);

        return redirect('/pedidos')->with('exito', '¡Pedido registrado con éxito!');
    }

    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        if ($pedido) {
            $pedido->delete();
            return redirect('/pedidos')->with('exito', '¡Pedido eliminado correctamente!');
        }
        return redirect('/pedidos')->with('error', 'El pedido no se pudo encontrar.');
    }

    // Función para mostrar la pantalla de edición con los datos del pedido actual
    public function edit($id)
    {
        $pedido = Pedido::with('cliente')->find($id);
        if (!$pedido) {
            return redirect('/pedidos')->with('error', 'Pedido no encontrado.');
        }
        return view('pedidos.edit', compact('pedido'));
    }

    // Función para guardar los cambios modificados en el formulario
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_pedido' => 'required|date',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'required|date',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|string|max:50',
        ]);

        $pedido = Pedido::find($id);
        if ($pedido) {
            $pedido->update([
                'fecha_pedido' => $request->fecha_pedido,
                'descripcion' => $request->descripcion,
                'fecha_entrega' => $request->fecha_entrega,
                'total' => $request->total,
                'saldo_pendiente' => $request->total, // Se recalcula temporalmente con el nuevo total
                'estado' => $request->estado,
            ]);
            return redirect('/pedidos')->with('exito', '¡Pedido actualizado correctamente!');
        }

        return redirect('/pedidos')->with('error', 'No se pudo actualizar el pedido.');
    }
}
