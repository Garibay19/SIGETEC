@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-pencil-square" style="color:#d4af37;"></i>
        Modificar Reporte Semanal
    </h1>
    <p class="text-muted">Actualiza o complementa las piezas diarias. Las sumas operarán de forma inmediata.</p>
</div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-4">

        <form action="{{ route('bonos.update', $bono->id_bono) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted">Trabajador</label>
                    <input type="text" class="form-control bg-light" value="{{ $bono->trabajador->nombre ?? 'Desconocido' }}" disabled>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" style="font-weight: 500;">Operación Realizada</label>
                    <input type="text" name="operacion" class="form-control" value="{{ $bono->operacion }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label" style="font-weight: 500;">Objetivo / Meta Semanal (Piezas)</label>
                    <input type="number" name="objetivo_semanal" class="form-control" value="{{ $bono->objetivo_semanal }}" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label" style="font-weight: 500;">Monto del Bono Base ($)</label>
                    <input type="number" name="monto_bono" step="0.01" class="form-control" value="{{ $bono->monto_bono > 0 ? $bono->monto_bono : 465.98 }}" required>
                    <small class="text-muted">Si actualmente no cumple, escribe aquí el valor original del bono para reevaluarlo.</small>
                </div>
            </div>

            <!-- CAPTURA HORIZONTAL POR DÍA (MODIFICABLE) -->
            <div class="card bg-light border-0 mb-4" style="border-radius: 10px;">
                <div class="card-header border-0 bg-transparent pt-3 pb-0 px-4">
                    <h5 style="font-weight: bold;" class="text-muted"><i class="bi bi-pencil-fill"></i> Actualizar Piezas Diarias</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col mb-2">
                            <label class="form-label text-secondary fw-bold">Lunes</label>
                            <input type="number" name="lunes" class="form-control text-center" value="{{ $bono->lunes }}">
                        </div>
                        <div class="col mb-2">
                            <label class="form-label text-secondary fw-bold">Martes</label>
                            <input type="number" name="martes" class="form-control text-center" value="{{ $bono->martes }}">
                        </div>
                        <div class="col mb-2">
                            <label class="form-label text-secondary fw-bold">Miércoles</label>
                            <input type="number" name="miercoles" class="form-control text-center" value="{{ $bono->miercoles }}">
                        </div>
                        <div class="col mb-2">
                            <label class="form-label text-secondary fw-bold">Jueves</label>
                            <input type="number" name="jueves" class="form-control text-center" value="{{ $bono->jueves }}">
                        </div>
                        <div class="col mb-2">
                            <label class="form-label text-secondary fw-bold">Viernes</label>
                            <input type="number" name="viernes" class="form-control text-center" value="{{ $bono->viernes }}">
                        </div>
                        <div class="col mb-2">
                            <label class="form-label text-secondary fw-bold">Sábado</label>
                            <input type="number" name="sabado" class="form-control text-center" value="{{ $bono->sabado }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-arrow-repeat"></i> Actualizar y Recalcular
                </button>
                <a href="/bonos" class="btn btn-secondary">
                    <i class="bi bi-x-circle-fill"></i> Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
