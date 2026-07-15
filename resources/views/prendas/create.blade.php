@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-plus-circle-fill" style="color:#d4af37;"></i>
        Registrar Nueva Prenda
    </h1>
    <p class="text-muted">Añade un nuevo diseño o muestra textil independiente al catálogo de SIGETEC.</p>
</div>

<div class="card shadow-sm border-0 mx-auto" style="border-radius: 15px; max-width: 700px;">
    <div class="card-body p-4">
        <!-- enctype="multipart/form-data" es obligatorio para poder subir imágenes a Laravel -->
        <form action="{{ route('prendas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nombre_prenda" class="form-label fw-bold">Nombre de la Prenda / Diseño</label>
                <input type="text" name="nombre_prenda" id="nombre_prenda" class="form-control" placeholder="Ejemplo: Sudadera con Capucha Negra" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label fw-bold">Categoría</label>
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="Caballero">Caballero</option>
                        <option value="Dama">Dama</option>
                        <option value="Infantil">Infantil</option>
                        <option value="Unisex">Unisex</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="talla" class="form-label fw-bold">Talla Base</label>
                    <select name="talla" id="talla" class="form-select">
                        <option value="CH">Chica (CH)</option>
                        <option value="M">Mediana (M)</option>
                        <option value="G">Grande (G)</option>
                        <option value="XG">Extra Grande (XG)</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="stock_disponible" class="form-label fw-bold">Stock Inicial Muestras</label>
                    <input type="number" name="stock_disponible" id="stock_disponible" class="form-control" value="1" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estatus" class="form-label fw-bold">Estatus Inicial</label>
                    <select name="estatus" id="estatus" class="form-select">
                        <option value="Diseño Nuevo">Diseño Nuevo</option>
                        <option value="Producción Activa">Producción Activa</option>
                    </select>
                </div>
            </div>

            <!-- NUEVO: Campo para seleccionar e incorporar la foto de la prenda -->
            <div class="mb-4">
                <label for="imagen" class="form-label fw-bold">Fotografía / Croquis de la Prenda</label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                <div class="form-text text-muted">Formatos permitidos: JPG, PNG, JPEG. Máximo 2MB.</div>
            </div>

            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="/prendas" class="btn btn-light border px-4" style="border-radius: 10px;">Cancelar</a>
                <button type="submit" class="btn btn-warning px-4" style="border-radius: 10px; font-weight: bold;">
                    <i class="bi bi-save-fill"></i> Guardar Prenda
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
