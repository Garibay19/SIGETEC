<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    // 1. Recibe y guarda un nuevo trabajador
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'puesto' => 'nullable|string|max:50',
            'area_asignada' => 'nullable|string|max:50',
            'estatus' => 'required|string|max:20',
        ]);

        Trabajador::create($request->all());

        return redirect('/trabajadores')->with('exito', '¡Trabajador registrado con éxito!');
    }

    // 2. Carga los datos del trabajador en la pantalla de editar
    public function edit($id)
    {
        $trabajador = Trabajador::find($id);
        if (!$trabajador) {
            return redirect('/trabajadores')->with('error', 'Trabajador no encontrado.');
        }
        return view('trabajadores.edit', compact('trabajador'));
    }

    // 3. Guarda los cambios del trabajador editado
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'puesto' => 'nullable|string|max:50',
            'area_asignada' => 'nullable|string|max:50',
            'estatus' => 'required|string|max:20',
        ]);

        $trabajador = Trabajador::find($id);
        if ($trabajador) {
            $trabajador->update($request->all());
            return redirect('/trabajadores')->with('exito', '¡Trabajador actualizado correctamente!');
        }

        return redirect('/trabajadores')->with('error', 'No se pudo actualizar el trabajador.');
    }

    // 4. Elimina un trabajador del taller de costura
    public function destroy($id)
    {
        $trabajador = Trabajador::find($id);
        if ($trabajador) {
            $trabajador->delete();
            return redirect('/trabajadores')->with('exito', '¡Trabajador eliminado correctamente!');
        }
        return redirect('/trabajadores')->with('error', 'El trabajador no se pudo encontrar.');
    }
}
