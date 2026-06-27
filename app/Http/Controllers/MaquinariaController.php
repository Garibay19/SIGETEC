<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use Illuminate\Http\Request;

class MaquinariaController extends Controller
{
    // 1. Guarda una nueva máquina en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre_maquina' => 'required|string|max:100',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'estatus' => 'required|string|max:50',
            'fecha_adquisicion' => 'nullable|date',
        ]);

        Maquinaria::create($request->all());

        return redirect('/maquinaria')->with('exito', '¡Máquina registrada con éxito!');
    }

    // 2. Carga los datos de la máquina seleccionada para el formulario de edición
    public function edit($id)
    {
        $maquinaria = Maquinaria::find($id);
        if (!$maquinaria) {
            return redirect('/maquinaria')->with('error', 'Máquina no encontrada.');
        }
        return view('maquinaria.edit', compact('maquinaria'));
    }

    // 3. Procesa y guarda las modificaciones de la máquina
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_maquina' => 'required|string|max:100',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'estatus' => 'required|string|max:50',
            'fecha_adquisicion' => 'nullable|date',
        ]);

        $maquinaria = Maquinaria::find($id);
        if ($maquinaria) {
            $maquinaria->update($request->all());
            return redirect('/maquinaria')->with('exito', '¡Máquina actualizada correctamente!');
        }

        return redirect('/maquinaria')->with('error', 'No se pudo actualizar el registro.');
    }

    // 4. Elimina la máquina del inventario del taller
    public function destroy($id)
    {
        $maquinaria = Maquinaria::find($id);
        if ($maquinaria) {
            $maquinaria->delete();
            return redirect('/maquinaria')->with('exito', '¡Máquina eliminada correctamente!');
        }
        return redirect('/maquinaria')->with('error', 'No se encontró el registro.');
    }
}
