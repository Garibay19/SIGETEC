<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    // Registra un pago desde el formulario de creación inicial
    public function store(Request $request)
    {
        
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id_pedido',
            'abono' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|string|max:50',
        ]);

        $pedido = Pedido::findOrFail($request->id_pedido);
        $nuevoSaldoRestante = $pedido->saldo_pendiente - $request->abono;

        if ($nuevoSaldoRestante < 0) {
            return redirect()->back()->with('error', 'El abono supera el saldo pendiente ($' . $pedido->saldo_pendiente . ').');
        }

        Pago::create([
            'id_pedido' => $pedido->id_pedido,
            'fecha_pago' => now(),
            'monto_total_pedido' => $pedido->total,
            'abono' => $request->abono,
            'saldo_restante' => $nuevoSaldoRestante,
            'metodo_pago' => $request->metodo_pago,
            'estado' => 'Completado'
        ]);

        $pedido->update(['saldo_pendiente' => $nuevoSaldoRestante]);

        return redirect('/pagos')->with('exito', '¡Abono registrado con éxito!');
    }

    // CARGA AVANZADA: Muestra la pantalla con el historial de abonos acumulados de este pedido
    public function edit($id)
    {
        // Buscamos el pago inicial para ubicar el pedido
        $pagoActual = Pago::findOrFail($id);
        $pedido = Pedido::with('cliente')->findOrFail($pagoActual->id_pedido);

        // Obtenemos todos los abonos históricos que se le han hecho a este pedido
        $historialPagos = Pago::where('id_pedido', $pedido->id_pedido)->orderBy('fecha_pago', 'asc')->get();

        return view('pagos.edit', compact('pagoActual', 'pedido', 'historialPagos'));
    }

    // REGISTRO ACUMULATIVO: Agrega una nueva fecha y abono sumándolo al historial del pedido
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_pago' => 'required|date',
            'abono' => 'required|numeric|min:0.01',
            'metodo_pago' => 'required|string|max:50',
        ]);

        $pagoActual = Pago::findOrFail($id);
        $pedido = Pedido::findOrFail($pagoActual->id_pedido);

        // Evaluamos el nuevo remanente matemático
        $nuevoSaldoRestante = $pedido->saldo_pendiente - $request->abono;

        if ($nuevoSaldoRestante < 0) {
            return redirect()->back()->with('error', 'Este nuevo abono supera el saldo pendiente actual ($' . $pedido->saldo_pendiente . ').');
        }

        // Creamos un nuevo registro en la tabla de pagos (Suma otra fecha al historial)
        Pago::create([
            'id_pedido' => $pedido->id_pedido,
            'fecha_pago' => $request->fecha_pago,
            'monto_total_pedido' => $pedido->total,
            'abono' => $request->abono,
            'saldo_restante' => $nuevoSaldoRestante,
            'metodo_pago' => $request->metodo_pago,
            'estado' => 'Completado'
        ]);

        // Actualizamos la deuda general del pedido en MySQL
        $pedido->update([
            'saldo_pendiente' => $nuevoSaldoRestante
        ]);

        return redirect('/pagos')->with('exito', '¡Nuevo abono acumulado y saldo actualizado!');
    }
}
