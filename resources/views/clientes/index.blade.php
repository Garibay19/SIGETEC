{{--estamos usando el diseño principal que hice en app.blade.php--}}
@extends('layouts.app')

{{--Lo que este aquise coloca donde esta @yield('contenido')en el layout--}}
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
    <input type="text" class="form-control w-50" placeholder="Buscar cliente...">
    <a href="/clientes/create" class="btn btn-warning">
        <i class="bi bi-people-fill"></i>
        Nuevo Cliente
    </a>
</div>

<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- CORREGIDO: Ciclo dinámico para recorrer los clientes reales -->
        @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id_cliente }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono ?? 'N/A' }}</td>
                <td>{{ $cliente->direccion ?? 'N/A' }}</td>
                <td>{{ $cliente->email ?? 'N/A' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <!-- Botón Editar dinámico con el ID del cliente -->
                        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </a>

                        <!-- Formulario seguro para eliminar al cliente -->
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro? Esta acción borrará también sus pedidos asociados.');" style="display:inline;">
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
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="bi bi-info-circle fs-4"></i> No hay clientes registrados en este momento.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
