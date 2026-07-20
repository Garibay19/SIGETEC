{{--estamos usando el diseño principal que hice en app.blade.php--}}
@extends('layouts.app')

{{--Lo que este aqui se coloca donde esta @yield('contenido') en el layout--}}
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
    <!-- CORREGIDO: Se añadió el id="inputBuscarMaterial" para capturar el texto en tiempo real -->
    <input type="text" id="inputBuscarMaterial" class="form-control w-50" placeholder="Buscar materiales por nombre, categoría o proveedor...">
    
    <!-- El rol de Invitado no puede ver el botón para crear nuevos materiales -->
    @if(auth()->user()?->role !== 'Invitado')
        <a href="/materiales/create" class="btn btn-warning">
            <i class="bi bi-box-seam-fill"></i> Nuevo Material
        </a>
    @endif
</div>

<div class="table-responsive">
    <table class="table table-striped align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th class="text-start">Material</th>
                <th>Categoría</th>
                <th>Stock Sano</th>
                <th>Stock Dañado</th>
                <th>Unidad</th>
                <th>Costo Unitario</th>
                <th>Proveedor</th>
                <th>Fecha Compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- CORREGIDO: Se añadió el id="tablaMateriales" para que JavaScript escanee las filas -->
        <tbody id="tablaMateriales">
            <!-- Ciclo dinámico conectado a la Base de Datos de MySQL -->
            @forelse($materiales as $material)
                <tr>
                    <td>{{ $material->id_material }}</td>
                    <td class="text-start"><strong>{{ $material->nombre_material }}</strong></td>
                    <td><span class="badge bg-light text-dark border">{{ $material->categoria }}</span></td>
                    <td class="fw-bold text-success">{{ number_format($material->stock) }}</td>
                    <td class="fw-bold {{ $material->stock_danado > 0 ? 'text-danger' : 'text-muted' }}">
                        {{ number_format($material->stock_danado) }}
                    </td>
                    <td>{{ $material->text_medida ?? $material->text_medida ?? $material->unidad_medida }}</td>
                    <td class="fw-bold">${{ number_format($material->costo_unitario, 2) }}</td>
                    <td>{{ $material->proveedor ?? 'N/A' }}</td>
                    <td>{{ $material->fecha_compra ? \Carbon\Carbon::parse($material->fecha_compra)->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            @if(auth()->user()?->role !== 'Invitado')
                                <a href="{{ route('materiales.edit', ['id' => $material->id_material]) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i> Editar
                                </a>
        
                                <form action="{{ route('materiales.destroy', ['id' => $material->id_material]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este material del inventario? Esta acción no se puede deshacer.');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <form action="{{ route('materiales.destroy', ['id' => $material->id_material]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este material del inventario? Esta acción no se puede deshacer.');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i> Eliminar
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 14px;">
                                    <i class="bi bi-eye-fill"></i> Solo Lectura
                                </span>
                            @endif
                        </div>
                    </td>  
                </tr>
            @empty
                <tr id="filaVacia" style="display: none;">
                    <td colspan="10" class="text-center text-muted py-4">
                        <i class="bi bi-info-circle fs-4"></i> No hay materiales registrados en el inventario actual.
                    </td>
                </tr>
            @endforelse
            
            <!-- NUEVO: Fila comodín que se activa si la búsqueda no encuentra ningún resultado -->
            <tr id="filaNoResultados" style="display: none;">
                <td colspan="10" class="text-center text-muted py-4">
                    <i class="bi bi-search fs-4"></i> No se encontraron materiales que coincidan con la búsqueda.
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- LÓGICA DE BÚSQUEDA FLUIDA EN TIEMPO REAL -->
<script>
    document.getElementById('inputBuscarMaterial').addEventListener('keyup', function() {
        const textoBusqueda = this.value.toLowerCase().trim();
        const filas = document.querySelectorAll('#tablaMateriales tr:not(#filaNoResultados):not(#filaVacia)');
        let coincidencias = 0;

        filas.forEach(fila => {
            const contenidoFila = fila.textContent.toLowerCase();
            
            if (contenidoFila.includes(textoBusqueda)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });

        const filaMensaje = document.getElementById('filaNoResultados');
        if (coincidencias === 0 && filas.length > 0) {
            filaMensaje.style.display = '';
        } else {
            filaMensaje.style.display = 'none';
        }
    });
</script>

@endsection
