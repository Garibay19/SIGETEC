@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-box-seam-fill"></i>
        Gestión de Materiales
    </h1>
    <p class="text-muted">
        Control y administración de los materiales disponibles.
    </p>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control w-50" placeholder="Buscar materiales...">
    <a href="/materiales/create" class="btn btn-warning">
        <i class="bi bi-box-seam-fill"></i> Nuevo Material
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th class="text-start">Material</th>
                <th>Categoría</th>
                <th>Stock Sano</th>
                <!-- NUEVO: Columna para visualizar el material mermado/dañado en el almacén -->
                <th>Stock Dañado</th>
                <th>Unidad</th>
                <th>Costo Unitario</th>
                <th>Proveedor</th>
                <th>Fecha Compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- CORREGIDO: Ciclo dinámico conectado a la Base de Datos de MySQL -->
            @forelse($materiales as $material)
                <tr>
                    <td>{{ $material->id_material }}</td>
                    <td class="text-start"><strong>{{ $material->nombre_material }}</strong></td>
                    <td><span class="badge bg-light text-dark border">{{ $material->categoria }}</span></td>
                    <td class="fw-bold text-success">{{ number_format($material->stock) }}</td>
                    <!-- Muestra la merma con un color de advertencia si es mayor a cero -->
                    <td class="fw-bold {{ $material->stock_danado > 0 ? 'text-danger' : 'text-muted' }}">
                        {{ number_format($material->stock_danado) }}
                    </td>
                    <td>{{ $material->unidad_medida }}</td>
                    <td class="fw-bold">${{ number_format($material->costo_unitario, 2) }}</td>
                    <td>{{ $material->proveedor ?? 'N/A' }}</td>
                    <td>{{ $material->fecha_compra ? \Carbon\Carbon::parse($material->fecha_compra)->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <!-- CORREGIDO: Botón Editar dinámico con el ID del material -->
                            <a href="{{ route('materiales.edit', $material->id_material) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>
    
                            <!-- CORREGIDO: Formulario seguro con token para remover el material del inventario -->
                            <form action="{{ route('materiales.destroy', $material->id_material) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este material del inventario? Esta acción no se puede deshacer.');" style="display:inline;">
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
                    <!-- CORREGIDO: Expandido el colspan a 10 para cubrir la nueva columna sin deformar la tabla -->
                    <td colspan="10" class="text-center text-muted py-4">
                        <i class="bi bi-info-circle fs-4"></i> No hay materiales registrados en el inventario actual.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
