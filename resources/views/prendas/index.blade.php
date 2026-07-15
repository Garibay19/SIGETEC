@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 style="font-weight:bold;">
                <i class="bi bi-scissors" style="color:#d4af37;"></i>
                Catálogo de Prendas y Diseños
            </h1>
            <p class="text-muted">Visualización de nuevos prototipos, muestras y prendas terminadas en el taller.</p>
        </div>
        @if(auth()->user()?->role !== 'Invitado')
            <a href="/prendas/create" class="btn btn-warning">
                <i class="bi bi-plus-circle-fill"></i> Registrar Nueva Prenda
            </a>
        @endif
    </div>
</div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Imagen (Clic para agrandar)</th>
                        <th class="text-start">Nombre de la Prenda</th>
                        <th>Categoría</th>
                        <th>Talla</th>
                        <th>Stock Muestras</th>
                        <th>Estatus</th>
                        @if(auth()->user()?->role !== 'Invitado')
                            <th>Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($prendas as $prenda)
                        <tr>
                            <td><strong>#{{ $prenda->id_prenda }}</strong></td>
                            <td>
                                @if($prenda->imagen)
                                    <!-- Al darle clic, llamamos a la función nativa pasando la ruta y el nombre -->
                                    <img 
                                        src="{{ asset('storage/' . $prenda->imagen) }}" 
                                        class="rounded border shadow-sm" 
                                        style="width: 60px; height: 60px; object-fit: cover; cursor: zoom-in;"
                                        onclick="agrandarImagen('{{ asset('storage/' . $prenda->imagen) }}', '{{ $prenda->nombre_prenda }}', '{{ $prenda->categoria ?? 'General' }}', '{{ $prenda->talla ?? 'N/A' }}')"
                                        title="Haga clic para ver en pantalla completa"
                                    >
                                @else
                                    <div class="bg-light text-muted rounded d-flex align-items-center justify-content-center mx-auto border" style="width: 60px; height: 60px; font-size: 24px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="text-start"><strong>{{ $prenda->nombre_prenda }}</strong></td>
                            <td><span class="badge bg-light text-dark border">{{ $prenda->categoria ?? 'General' }}</span></td>
                            <td><span class="fw-bold text-secondary">{{ $prenda->talla ?? 'N/A' }}</span></td>
                            <td class="fw-bold">{{ number_format($prenda->stock_disponible) }} pzas</td>
                            <td>
                                @if($prenda->estatus == 'Diseño Nuevo')
                                    <span class="badge bg-info text-dark">Diseño Nuevo</span>
                                @else
                                    <span class="badge bg-success">Producción Activa</span>
                                @endif
                            </td>
                            @if(auth()->user()?->role !== 'Invitado')
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <form action="{{ route('prendas.destroy', ['id' => $prenda->id_prenda]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta prenda del catálogo?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()?->role !== 'Invitado' ? 8 : 7 }}" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle fs-4"></i> No hay prendas registradas en el catálogo actualmente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- UN SOLO MODAL GLOBAL NATIVO AL FINAL DE LA PANTALLA (Elegante, oscuro y fluido) -->
<div id="pantallaCompletaModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.85); align-items: center; justify-content: center; backdrop-filter: blur(5px);">
    <!-- Botón de cerrar -->
    <span onclick="cerrarModal()" style="position: absolute; top: 20px; right: 30px; color: #fff; font-size: 40px; font-weight: bold; cursor: pointer; transition: 0.3s; z-index: 10000;">&times;</span>
    
    <div style="max-width: 700px; width: 90%; background: #222; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
        <!-- Imagen -->
        <img id="imagenDestino" style="width: 100%; max-height: 70vh; object-fit: contain; background: #111;">
        <!-- Pie de foto informativo -->
        <div style="padding: 20px; color: #fff; border-top: 2px solid #d4af37;">
            <h5 id="textoTitulo" style="margin: 0; font-weight: bold; color: #d4af37;"></h5>
            <small id="textoDetalles" style="color: #aaa;"></small>
        </div>
    </div>
</div>

<!-- LÓGICA DE INYECCIÓN DIRECTA SIN DEPENDER DE LIBRERÍAS EXTERNAS -->
<script>
    function agrandarImagen(ruta, titulo, categoria, talla) {
        document.getElementById('imagenDestino').src = ruta;
        document.getElementById('textoTitulo').innerHTML = '<i class="bi bi-tag-fill"></i> ' + titulo;
        document.getElementById('textoDetalles').innerText = 'Categoría: ' + categoria + ' | Talla: ' + talla;
        
        // Mostramos el modal con animación flex
        const modal = document.getElementById('pantallaCompletaModal');
        modal.style.display = 'flex';
    }

    function cerrarModal() {
        document.getElementById('pantallaCompletaModal').style.display = 'none';
    }

    // Cerrar también si presionan la tecla Esc por comodidad
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            cerrarModal();
        }
    });
</script>

@endsection
