{{--estamos usando el diseño principal que hice en app.blade.php--}}
@extends('layouts.app')

{{--Lo que este aqui se coloca donde esta @yield('contenido') en el layout--}}
@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-people-fill"></i>
        Gestión de Clientes
    </h1>
    <p class="text-muted">
        Administra la información de los clientes registrados.
    </p>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <!-- CORREGIDO: Se añadió el id="inputBuscar" para poder capturar el texto en tiempo real -->
    <input type="text" id="inputBuscar" class="form-control w-50" placeholder="Buscar cliente por nombre, teléfono o correo...">
    
    <!-- El rol de Invitado no puede ver el botón para crear nuevos clientes -->
    @if(auth()->user()?->role !== 'Invitado')
        <a href="/clientes/create" class="btn btn-warning">
            <i class="bi bi-people-fill"></i>
            Nuevo Cliente
        </a>
    @endif
</div>

<table class="table table-striped align-middle text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th class="text-start">Nombre Completo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <!-- CORREGIDO: Se añadió el id="tablaClientes" para que JavaScript pueda escanear las filas -->
    <tbody id="tablaClientes">
        <!-- Ciclo dinámico para recorrer los clientes reales -->
        @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id_cliente }}</td>
                <td class="text-start nombre-cliente">{{ $cliente->nombre_completo }}</td>
                <td>{{ $cliente->telefono ?? 'N/A' }}</td>
                <td>{{ $cliente->direccion ?? 'N/A' }}</td>
                <td>{{ $cliente->correo ?? 'N/A' }}</td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <!-- Verificación de rol para bloquear acciones al rol Invitado -->
                        @if(auth()->user()?->role !== 'Invitado')
                            <a href="{{ route('clientes.edit', ['id' => $cliente->id_cliente]) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Editar
                            </a>

                            <form action="{{ route('clientes.destroy', ['id' => $cliente->id_cliente]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro? Esta acción borrará también sus pedidos asociados.');" style="display:inline;">
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
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="bi bi-info-circle fs-4"></i> No hay clientes registrados en este momento.
                </td>
            </tr>
        @endforelse
        
        <!-- NUEVO: Fila comodín que se activa si la búsqueda no encuentra ningún resultado -->
        <tr id="filaNoResultados" style="display: none;">
            <td colspan="6" class="text-center text-muted py-4">
                <i class="bi bi-search fs-4"></i> No se encontraron clientes que coincidan con la búsqueda.
            </td>
        </tr>
    </tbody>
</table>

<!-- LÓGICA DE BÚSQUEDA FLUIDA EN TIEMPO REAL -->
<script>
    document.getElementById('inputBuscar').addEventListener('keyup', function() {
        const textoBusqueda = this.value.toLowerCase().trim();
        const filas = document.querySelectorAll('#tablaClientes tr:not(#filaNoResultados):not(#filaVacia)');
        let coincidencias = 0;

        filas.forEach(filas => {
            // Evaluamos todo el contenido de texto de la fila (Nombre, Teléfono, Correo, etc.)
            const contenidoFila = filas.textContent.toLowerCase();
            
            if (contenidoFila.includes(textoBusqueda)) {
                filas.style.display = '';
                coincidencias++;
            } else {
                filas.style.display = 'none';
            }
        });

        // Si no hay ningún cliente que coincida, mostramos el mensaje de advertencia
        const filaMensaje = document.getElementById('filaNoResultados');
        if (coincidencias === 0 && filas.length > 0) {
            filaMensaje.style.display = '';
        } else {
            filaMensaje.style.display = 'none';
        }
    });
</script>

@endsection
