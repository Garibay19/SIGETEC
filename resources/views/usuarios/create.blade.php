@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-person-plus-fill" style="color:#d4af37;"></i>
        Nuevo Usuario
    </h1>
    <p class="text-muted">
        Registra un nuevo usuario en el sistema.
    </p>
</div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-4">

        <!-- Formulario enlazado al controlador de usuarios con seguridad activa -->
        <form action="{{ route('usuarios.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Nombre Completo</label>
                <input type="text" name="name" class="form-control" placeholder="Nombre del usuario" required>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="********" required minlength="8">
                <small class="text-muted">La contraseña debe tener mínimo 8 caracteres.</small>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Rol</label>
                <select name="role" class="form-control" required>
                    <option value="Invitado">Invitado (Solo Lectura / Uso Básico)</option>
                    <option value="Administrador">Administrador (Gestiona cuentas y aplicaciones)</option>
                    <option value="Superadministrador">Superadministrador (Control total del sistema)</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" style="font-weight: 500;">Estado</label>
                <select name="status" class="form-control" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle-fill"></i> Guardar
                </button>
                <a href="/usuarios" class="btn btn-secondary">
                    <i class="bi bi-x-circle-fill"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
