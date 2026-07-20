<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with('cliente')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validamos que los datos que vienen del formulario cumplan con las reglas de negocio
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente', 
            'descripcion' => 'required|string',
            'fecha_entrega' => 'required|date',
            'estado' => 'required|string',
            'total' => 'required|numeric|min:0',
            'saldo_pendiente' => 'required|numeric|min:0',
        ]);

        // 2. Insertamos el registro de forma real en la tabla de pedidos de MySQL
        Pedido::create([
            'id_cliente' => $request->id_cliente,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'estado' => $request->estado,
            'total' => $request->total,
            'saldo_pendiente' => $request->saldo_pendiente,
            'fecha_pedido' => date('Y-m-d') 
        ]);

        // 3. Redireccionamos al listado general de pedidos con un mensaje de éxito
        return redirect('/pedidos')->with('success', '¡El pedido ha sido registrado y enlazado con éxito!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pedido = Pedido::findOrFail($id);
        $clientes = Cliente::orderBy('nombre_completo', 'asc')->get();
        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'descripcion' => 'required|string',
            'fecha_entrega' => 'required|date',
            'estado' => 'required|string',
            'total' => 'required|numeric|min:0',
            'saldo_pendiente' => 'required|numeric|min:0',
        ]);

        $pedido->update([
            'id_cliente' => $request->id_cliente,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'estado' => $request->estado,
            'total' => $request->total,
            'saldo_pendiente' => $request->saldo_pendiente,
        ]);

        return redirect('/pedidos')->with('success', '¡Pedido actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect('/pedidos')->with('success', 'Pedido eliminado correctamente.');
    }
}
