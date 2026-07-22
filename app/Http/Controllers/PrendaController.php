<?php

namespace App\Http\Controllers;

use App\Models\Prenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrendaController extends Controller
{
    // Guarda el registro con el procesamiento de imagen
    public function index()
{
    $prendas = Prenda::orderBy('id_prenda', 'desc')->get();

    return view('prendas.index', compact('prendas'));
}
    
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre_prenda' => 'required|string|max:150',
            'stock_disponible' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
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
    'imagen' => $rutaImagen,
]);

return redirect('/prendas')->with('success', 'Prenda registrada correctamente.');
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
