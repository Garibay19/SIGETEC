<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // 1. Recibe y registra un nuevo material en el inventario
    public function store(Request $request)
    {
        $request->validate([
            'nombre_material' => 'required|string|max:100',
            'categoria' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'stock_danado' => 'required|integer|min:0', // Validación de dañado
            'unidad_medida' => 'required|string|max:30',
            'costo_unitario' => 'required|numeric|min:0',
            'proveedor' => 'nullable|string|max:100',
            'fecha_compra' => 'nullable|date',
        ]);

        Material::create($request->all());

        return redirect('/materiales')->with('exito', '¡Material agregado al inventario!');
    }

    // 2. Muestra el formulario de edición con los datos del insumo actual
    public function edit($id)
    {
        $material = Material::find($id);
        if (!$material) {
            return redirect('/materiales')->with('error', 'Material no encontrado.');
        }
        return view('materiales.edit', compact('material'));
    }

    // 3. Procesa y guarda las modificaciones o mermas del material
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_material' => 'required|string|max:100',
            'categoria' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'stock_danado' => 'required|integer|min:0',
            'unidad_medida' => 'required|string|max:30',
            'costo_unitario' => 'required|numeric|min:0',
            'proveedor' => 'nullable|string|max:100',
            'fecha_compra' => 'nullable|date',
        ]);

        $material = Material::find($id);
        if ($material) {
            $material->update($request->all());
            return redirect('/materiales')->with('exito', '¡Inventario actualizado correctamente!');
        }

        return redirect('/materiales')->with('error', 'No se pudo actualizar el material.');
    }

    // 4. Elimina un material del catálogo de inventario
    public function destroy($id)
    {
        $material = Material::find($id);
        if ($material) {
            $material->delete();
            return redirect('/materiales')->with('exito', '¡Material removido del inventario!');
        }
        return redirect('/materiales')->with('error', 'El material no se pudo encontrar.');
    }
}
