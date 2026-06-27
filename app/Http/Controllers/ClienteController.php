<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // 1. Guarda el cliente nuevo de forma correcta
    public function store(Request $request)
    {
        // CORREGIDO: Ahora se valida 'nombre_completo' en lugar de 'nombre'
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:200',
            'observaciones' => 'nullable|string',
        ]);

        // Guarda todos los campos del formulario en MySQL
        Cliente::create($request->all());

        return redirect('/clientes')->with('exito', '¡Cliente registrado con éxito!');
    }

    // 2. Abre el formulario de edición con los datos del cliente seleccionado
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect('/clientes')->with('error', 'Cliente no encontrado.');
        }
        return view('clientes.edit', compact('cliente'));
    }

    // 3. Guarda los cambios modificados en el formulario de edición
    public function update(Request $request, $id)
    {
        // CORREGIDO: Validación adaptada a 'nombre_completo'
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:200',
            'observaciones' => 'nullable|string',
        ]);

        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->update($request->all());
            return redirect('/clientes')->with('exito', '¡Cliente actualizado correctamente!');
        }

        return redirect('/clientes')->with('error', 'No se pudo actualizar el cliente.');
    }

    // 4. Borra al cliente de la base de datos
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return redirect('/clientes')->with('exito', '¡Cliente eliminado correctamente!');
        }
        return redirect('/clientes')->with('error', 'El cliente no se pudo encontrar.');
    }
}
