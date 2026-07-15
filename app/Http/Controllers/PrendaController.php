<?php

namespace App\Http\Controllers;

use App\Models\Prenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrendaController extends Controller
{
    // Guarda el registro con el procesamiento de imagen
    public function store(Request $request)
    {
        $request->validate([
            'nombre_prenda' => 'required|string|max:150',
            'stock_disponible' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validación de foto de 2MB
        ]);

        $rutaImagen = null;

        // Si el usuario adjuntó una foto, Laravel la mueve automáticamente a la carpeta de almacenamiento seguro
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('prendas_fotos', 'public');
        }

        Prenda::create([
            'nombre_prenda' => $request->nombre_prenda,
            'categoria' => $request->categoria,
            'talla' => $request->talla,
            'stock_disponible' => $request->stock_disponible,
            'estatus' => $request->estatus,
            'imagen' => $rutaImagen, // Guardamos la ruta del archivo
        ]);

        return redirect('/prendas');
    }

    // Elimina el registro físico y borra su archivo de imagen asociado para no llenar el disco duro
    public function destroy($id)
    {
        $prenda = Prenda::findOrFail($id);

        if ($prenda->imagen) {
            Storage::disk('public')->delete($prenda->imagen);
        }

        $prenda->delete();
        return redirect('/prendas');
    }
}
