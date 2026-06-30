<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // 1. Guarda un nuevo usuario con contraseña encriptada
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptación segura de Laravel
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('/usuarios')->with('exito', '¡Usuario registrado correctamente!');
    }

    // 2. Abre el editor cargando los datos
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        
        // Bloqueo de seguridad: Un Administrador no puede alterar o editar a un Superadministrador
        if (auth()->user()->role == 'Administrador' && $usuario->role == 'Superadministrador') {
            return redirect('/usuarios')->with('error', 'No tienes permisos para alterar datos del Superadministrador.');
        }

        return view('usuarios.edit', compact('usuario'));
    }

    // 3. Procesa la actualización
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'role' => 'required|string',
            'status' => 'required|string',
        ]);

        // CORREGIDO: Validación segura y aislada si se decide cambiar la contraseña
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8'
            ]);
            $usuario->password = Hash::make($request->password);
        }

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role;
        $usuario->status = $request->status;
        $usuario->save();

        return redirect('/usuarios')->with('exito', '¡Usuario actualizado con éxito!');
    }

    // 4. Elimina un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // CORREGIDO: Protección estricta para evitar que el usuario activo se borre a sí mismo
        if ($usuario->id === auth()->id()) {
            return redirect('/usuarios')->with('error', 'Acción denegada. No puedes eliminar tu propia cuenta en uso.');
        }

        // Protección estricta: Nadie puede borrar al Superadministrador
        if ($usuario->role == 'Superadministrador') {
            return redirect('/usuarios')->with('error', 'Acción denegada. El Superadministrador no puede ser eliminado.');
        }

        $usuario->delete();
        return redirect('/usuarios')->with('exito', '¡Usuario removido del sistema!');
    }
}
