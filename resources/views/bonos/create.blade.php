@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-trophy-fill" style="color:#d4af37;"></i>
        Registro de Producción y Bonos Semanales
    </h1>
    <p class="text-muted">
        Captura las piezas confeccionadas por día. El sistema calculará la meta y el cumplimiento de forma automática.
    </p>
</div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-4">

        <!-- Formulario enlazado al controlador de bonos con autocompletado apagado -->
        <form action="{{ route('bonos.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="row">
                <!-- COLUMNA IZQUIERDA: DATOS GENERALES -->
                <div class="col-md-6 mb-3">
                    <label class="form-label" style="font-weight: 500;">Seleccionar Trabajador</label>
                    <select name="id_trabajador" class="form-control" required>
                        <option value="">-- Seleccione un Empleado --</option>
                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->id_trabajador }}">{{ $trabajador->nombre }} ({{ $trabajador->puesto }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" style="font-weight: 500;">Operación / Proceso Realizado</label>
                    <input type="text" name="operacion" class="form-control" placeholder="Ejemplo: PEGADO PUÑO, DOBLADILLO, OVERLEADO" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label" style="font-weight: 500;">Objetivo / Meta Semanal (Piezas)</label>
                    <input type="number" name="objetivo_semanal" class="form-control" placeholder="Ejemplo: 9360" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label" style="font-weight: 500;">Monto del Bono Comercial ($)</label>
                    <input type="number" name="monto_bono" step="0.01" class="form-control" placeholder="Ejemplo: 465.98" required>
                </div>
            </div>

            <!-- SECCIÓN PRÁCTICA: CAPTURA DE PRODUCCIÓN DIARIA (ESTILO EXCEL) -->
            <div class="card bg-light border-0 mb-4" style="border-radius: 10px;">
                <div class="card-header border-0 bg-transparent pt-3 pb-0 px-4">
                    <h5 style="font-weight: bold;" class="text-muted"><i class="bi bi-calendar-week"></i> Reporte de Piezas por Día</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col-md-2 mb-2">
                            <label class="form-label text-secondary fw-bold">Lunes</label>
                            <input type="number" name="lunes" class="form-control text-center" value="0" min="0">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label text-secondary fw-bold">Martes</label>
                            <input type="number" name="martes" class="form-control text-center" value="0" min="0">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label text-secondary fw-bold">Miércoles</label>
                            <input type="number" name="miercoles" class="form-control text-center" value="0" min="0">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label text-secondary fw-bold">Jueves</label>
                            <input type="number" name="jueves" class="form-control text-center" value="0" min="0">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label text-secondary fw-bold">Viernes</label>
                            <input type="number" name="viernes" class="form-control text-center" value="0" min="0">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label text-secondary fw-bold">Sábado</label>
                            <input type="number" name="sabado" class="form-control text-center" value="0" min="0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle-fill"></i> Procesar y Evaluar Bono
                </button>
                <a href="/bonos" class="btn btn-secondary">
                    <i class="bi bi-x-circle-fill"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
