@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-person-badge-fill"></i>
        Gestión de Usuarios
    </h1>
    <p class="text-muted">
        Administra los usuarios autorizados para acceder al sistema.
    </p>
</div>

<!-- ALERTAS DE CONTROL -->
@if(session('exito'))
    <div class="alert alert-success shadow-sm">{{ session('exito') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
@endif

<div class="text-end mb-3">
    <!-- CORREGIDO: Uso de ?-> para evitar errores si no hay una sesión activa -->
    @if(auth()->user()?->role !== 'Invitado')
        <a href="/usuarios/create" class="btn btn-warning">
            <i class="bi bi-person-badge-fill"></i> Nuevo Usuario
        </a>
    @endif
</div>

<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th class="text-start">Nombre</th>
                <th class="text-start">Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Ciclo dinámico conectado a la Base de Datos de MySQL -->
            @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td class="text-start"><strong>{{ $usuario->name }}</strong></td>
                    <td class="text-start text-muted">{{ $usuario->email }}</td>
                    <td>
                        <!-- Identificadores visuales específicos para cada jerarquía de permisos -->
                        @if($usuario->role == 'Superadministrador')
                            <span class="badge bg-dark p-2 text-warning border border-warning" style="font-size: 11px;">
                                <i class="bi bi-shield-fill-check"></i> Super-Admin
                            </span>
                        @elseif($usuario->role == 'Administrador')
                            <span class="badge bg-danger p-2" style="font-size: 11px;">
                                <i class="bi bi-shield-shaded"></i> Administrador
                            </span>
                        @else
                            <span class="badge bg-secondary p-2" style="font-size: 11px;">
                                <i class="bi bi-eye-fill"></i> Invitado
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($usuario->status == 'Activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-light text-dark border">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <!-- CORREGIDO: Navegación segura con ?-> para el rol del usuario autenticado -->
                            @if(auth()->user()?->role !== 'Invitado')
                                
                                <!-- Bloqueo en cascada: Un administrador normal no puede alterar al superadministrador -->
                                @if(auth()->user()?->role == 'Administrador' && $usuario->role == 'Superadministrador')
                                    <span class="text-muted small"><i class="bi bi-lock-fill"></i> Protegido</span>
                                @else
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i> Editar
                                    </a>
            
                                    <!-- Protección estricta: Nadie puede remover al superadministrador -->
                                    @if($usuario->role !== 'Superadministrador')
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este usuario?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i> Eliminar
                                            </button>
                                        </form>
                                    @endif
                                @endif

                            @else
                                <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 11px;">
                                    <i class="bi bi-slash-circle"></i> Sin permisos
                                </span>
                            @endif
                        </div>
                    </td>  
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-info-circle fs-4"></i> No hay cuentas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
