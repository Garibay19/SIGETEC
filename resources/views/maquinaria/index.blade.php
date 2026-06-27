@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-gear-fill"></i>
        Gestión de Maquinaria
    </h1>
    <p class="text-muted">
        Administra la maquinaria y equipos registrados.
    </p>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control w-50" placeholder="Buscar maquinaria...">
    <a href="/maquinaria/create" class="btn btn-warning">
        <i class="bi bi-gear-fill"></i> Nueva Máquina 
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th class="text-start">Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Estado</th>
                <th>Fecha de Adquisición</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- CORREGIDO: Ciclo dinámico conectado a la Base de Datos de MySQL -->
            @forelse($maquinarias as $maquina)
                <tr>
                    <td>{{ $maquina->id_maquinaria }}</td>
                    <td class="text-start"><strong>{{ $maquina->nombre_maquina }}</strong></td>
                    <td>{{ $maquina->marca }}</td>
                    <td>{{ $maquina->modelo }}</td>
                    <td>
                        <!-- Identificador de color dinámico según el estatus de la máquina -->
                        @if($maquina->estatus == 'Operando')
                            <span class="badge bg-success">Operando</span>
                        @elseif($maquina->estatus == 'En reparación')
                            <span class="badge bg-warning text-dark">En reparación</span>
                        @else
                            <span class="badge bg-danger">Fuera de servicio</span>
                        @endif
                    </td>
                    <td>{{ $maquina->fecha_adquisicion ? \Carbon\Carbon::parse($maquina->fecha_adquisicion)->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <!-- CORREGIDO: Botón Editar dinámico con el ID de la máquina -->
                            <a href="{{ route('maquinaria.edit', $maquina->id_maquinaria) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>
    
                            <!-- CORREGIDO: Formulario seguro con token para eliminar la máquina del sistema -->
                            <form action="{{ route('maquinaria.destroy', $maquina->id_maquinaria) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta máquina del registro? Esta acción no se puede deshacer.');" style="display:inline;">
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
                        <i class="bi bi-info-circle fs-4"></i> No hay maquinaria o equipos registrados en este momento.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
