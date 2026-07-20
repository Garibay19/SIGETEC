{{--estamos usando el diseño principal que hice en app.blade.php--}}
@extends('layouts.app')

{{--Lo que este aqui se coloca donde esta @yield('contenido') en el layout--}}
@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-person-fill"></i>
        Gestión de Trabajadores
    </h1>
    <p class="text-muted">
        Administra la información y el estatus del personal del taller.
    </p>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <!-- CORREGIDO: Se añadió el id="inputBuscarTrabajador" para capturar el texto en tiempo real -->
    <input type="text" id="inputBuscarTrabajador" class="form-control w-50" placeholder="Buscar trabajador por nombre, puesto o teléfono...">
    
    <!-- El rol de Invitado no puede ver el botón para registrar nuevos trabajadores -->
    @if(auth()->user()?->role !== 'Invitado')
        <a href="/trabajadores/create" class="btn btn-warning">
            <i class="bi bi-person-plus-fill"></i>
            Nuevo Trabajador
        </a>
    @endif
</div>

<table class="table table-striped align-middle text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th class="text-start">Nombre Completo</th>
            <th>Puesto / Función</th>
            <th>Teléfono</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <!-- CORREGIDO: Se añadió el id="tablaTrabajadores" para que JavaScript escanee las filas -->
    <tbody id="tablaTrabajadores">
        <!-- Ciclo dinámico de Laravel para recorrer los trabajadores reales -->
        @forelse($trabajadores as $trabajador)
            <tr>
                <td>{{ $trabajador->id_trabajador }}</td>
                <td class="text-start"><strong>{{ $trabajador->nombre }}</strong></td>
                <td><span class="badge bg-light text-dark border">{{ $trabajador->puesto ?? 'Operador' }}</span></td>
                <td>{{ $trabajador->telefono ?? 'N/A' }}</td>
                <td>
                    @if(($trabajador->estatus ?? $trabajador->status) == 'Activo')
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <!-- Verificación de rol para bloquear acciones al rol Invitado -->
                        @if(auth()->user()?->role !== 'Invitado')
                            <a href="{{ route('trabajadores.edit', ['id' => $trabajador->id_trabajador]) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>

                            <form action="{{ route('trabajadores.destroy', ['id' => $trabajador->id_trabajador]) }}" method="POST" onsubmit="return confirm('¿Está seguro de dar de baja a este trabajador? Esta acción conservará sus registros históricos de bonos.');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </button>
                            </form>
                        @else
                            <!-- CORREGIDO: Sincronizada la insignia de Solo Lectura a 14px como los demás módulos -->
                            <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 14px;">
                                <i class="bi bi-eye-fill"></i> Solo Lectura
                            </span>
                        @endif
                    </div>
                </td>    
            </tr>
        @empty
            <tr id="filaVacia" style="display: none;">
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="bi bi-info-circle fs-4"></i> No hay trabajadores registrados en este momento.
                </td>
            </tr>
        @endforelse
        
        <!-- NUEVO: Fila comodín que se activa si la búsqueda no encuentra coincidencias -->
        <tr id="filaNoResultados" style="display: none;">
            <td colspan="6" class="text-center text-muted py-4">
                <i class="bi bi-search fs-4"></i> No se encontraron trabajadores que coincidan con la búsqueda.
            </td>
        </tr>
    </tbody>
</table>

<!-- LÓGICA DE BÚSQUEDA EN TIEMPO REAL -->
<script>
    document.getElementById('inputBuscarTrabajador').addEventListener('keyup', function() {
        const textoBusqueda = this.value.toLowerCase().trim();
        const filas = document.querySelectorAll('#tablaTrabajadores tr:not(#filaNoResultados):not(#filaVacia)');
        let coincidencias = 0;

        filas.forEach(fila => {
            // Evaluamos todo el texto contenido en la fila (ID, Nombre, Puesto, etc.)
            const contenidoFila = fila.textContent.toLowerCase();
            
            if (contenidoFila.includes(textoBusqueda)) {
                fila.style.display = '';
                coincidencias++;
            } else {
                fila.style.display = 'none';
            }
        });

        // Si no hay resultados que coincidan, mostramos el mensaje de advertencia
        const filaMensaje = document.getElementById('filaNoResultados');
        if (coincidencias === 0 && filas.length > 0) {
            filaMensaje.style.display = '';
        } else {
            filaMensaje.style.display = 'none';
        }
    });
</script>

@endsection
