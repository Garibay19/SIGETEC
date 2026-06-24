@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-person-workspace"></i>
        Gestión de Trabajadores
    </h1>
    <p class="text-muted">
        Administra la información del personal autorizado.
    </p>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control w-50" placeholder="Buscar Trabajadores...">
    <a href="/trabajadores/create" class="btn btn-warning">
        <i class="bi bi-person-workspace"></i>
        Nuevo Trabajador
    </a>
</div>

<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Teléfono</th>
            <th>Puesto</th>
            <th>Área asignada</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <!-- CORREGIDO: Ciclo dinámico para recorrer los trabajadores reales de MySQL -->
        @forelse($trabajadores as $trabajador)
            <tr>
                <td>{{ $trabajador->id_trabajador }}</td>
                <td>{{ $trabajador->nombre }}</td>
                <td>{{ $trabajador->telefono ?? 'N/A' }}</td>
                <td>{{ $trabajador->puesto ?? 'N/A' }}</td>
                <td>{{ $trabajador->area_asignada ?? 'N/A' }}</td>
                <td>
                    <!-- CORREGIDO: Marcador visual dinámico según el estatus del empleado -->
                    @if($trabajador->estatus == 'Activo')
                        <span class="badge bg-success">Activo</span>
                    @elseif($trabajador->estatus == 'Inactivo')
                        <span class="badge bg-danger">Inactivo</span>
                    @else
                        <span class="badge bg-warning text-dark">Vacaciones</span>
                    @endif
                </td>
                
                <td>
                    <div class="d-flex gap-2">
                        <!-- CORREGIDO: Botón Editar dinámico con el ID del trabajador -->
                        <a href="{{ route('trabajadores.edit', $trabajador->id_trabajador) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </a>

                        <!-- CORREGIDO: Formulario seguro para eliminar al trabajador -->
                        <form action="{{ route('trabajadores.destroy', $trabajador->id_trabajador) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro? Esta acción no se puede deshacer.');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </td>  
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="bi bi-info-circle fs-4"></i> No hay trabajadores registrados en este momento.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
