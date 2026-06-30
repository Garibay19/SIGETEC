@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Editar Usuario
    </h1>
    <p class="text-muted">
        Modifica la información del usuario seleccionado.
    </p>
</div>

<div class="card shadow p-4" style="border-radius: 15px; border: 0;">
    <!-- CORREGIDO: Formulario enlazado a la ruta update con método seguro PUT y autocompletado apagado -->
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label" style="font-weight: 500;">Nombre Completo</label>
            <!-- CORREGIDO: value dinámico con name="name" y obligatorio -->
            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight: 500;">Correo Electrónico</label>
            <!-- CORREGIDO: value dinámico con name="email" y obligatorio -->
            <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight: 500;">Nueva Contraseña (Opcional)</label>
            <!-- CORREGIDO: name="password" añadido. Si se deja en blanco, el sistema conserva la contraseña actual -->
            <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para mantener la contraseña actual" minlength="8">
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight: 500;">Rol</label>
            <!-- CORREGIDO: Selector dinámico con los roles jerárquicos autorizados en el sistema -->
            <select name="role" class="form-select" required>
                <option value="Invitado" {{ $usuario->role == 'Invitado' ? 'selected' : '' }}>Invitado (Solo Lectura / Uso Básico)</option>
                <option value="Administrador" {{ $usuario->role == 'Administrador' ? 'selected' : '' }}>Administrador (Gestiona cuentas y aplicaciones)</option>
                <option value="Superadministrador" {{ $usuario->role == 'Superadministrador' ? 'selected' : '' }}>Superadministrador (Control total del sistema)</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label" style="font-weight: 500;">Estado</label>
            <!-- CORREGIDO: name="status" añadido con marcador select inteligente -->
            <select name="status" class="form-select" required>
                <option value="Activo" {{ $usuario->status == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $usuario->status == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <!-- CORREGIDO: type="submit" añadido para procesar la actualización en el controlador -->
        <button type="submit" class="btn btn-success">
            <i class="bi bi-check-circle-fill"></i> Actualizar
        </button>

        <a href="/usuarios" class="btn btn-secondary">
            <i class="bi bi-x-circle-fill"></i> Cancelar
        </a>
    </form>
</div>

@endsection
