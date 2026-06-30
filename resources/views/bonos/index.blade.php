@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-cash-coin"></i>
        Control de Production y Bonos
    </h1>
    <p class="text-muted">
        Monitoreo semanal de objetivos de confección y estatus de cumplimiento de metas.
    </p>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control w-25" placeholder="Buscar registro...">
    
    <!-- CORREGIDO: El rol de Invitado no puede ver el botón para crear nuevos registros semanales -->
    @if(auth()->user()?->role !== 'Invitado')
        <a href="/bonos/create" class="btn btn-warning">
            <i class="bi bi-plus-circle-fill"></i> Nuevo Registro Semanal
        </a>
    @endif
</div>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-center" style="font-size: 14px;">
                <thead class="table-light">
                    <tr>
                        <th>OPERACIÓN</th>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>OBJETIVO</th>
                        <th>L</th>
                        <th>M</th>
                        <th>M</th>
                        <th>J</th>
                        <th>V</th>
                        <th>S</th>
                        <th>TOTAL</th>
                        <th>BONO</th>
                        <th>APLICA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo dinámico conectado a tu Base de Datos en MySQL -->
                    @forelse($bonos as $bono)
                        <tr>
                            <td class="text-start"><strong>{{ $bono->operacion }}</strong></td>
                            <td>{{ $bono->id_trabajador }}</td>
                            <td class="text-start">{{ $bono->trabajador->nombre ?? 'Desconocido' }}</td>
                            <td class="table-info fw-bold">{{ number_format($bono->objetivo_semanal) }}</td>
                            <td>{{ $bono->lunes }}</td>
                            <td>{{ $bono->martes }}</td>
                            <td>{{ $bono->miercoles }}</td>
                            <td>{{ $bono->jueves }}</td>
                            <td>{{ $bono->viernes }}</td>
                            <td>{{ $bono->sabado }}</td>
                            <td class="fw-bold">{{ number_format($bono->total_piezas) }}</td>
                            <td class="text-success fw-bold">${{ number_format($bono->monto_bono, 2) }}</td>
                            <td>
                                <!-- Muestra el estatus dinámico según el cumplimiento de la meta -->
                                @if($bono->cumplimiento == 'Cumple')
                                    <span class="badge bg-success p-2" style="font-size: 12px; width: 90px;">
                                        <i class="bi bi-check-circle-fill"></i> Cumple
                                    </span>
                                @else
                                    <span class="badge bg-danger p-2" style="font-size: 12px; width: 90px;">
                                        <i class="bi bi-x-circle-fill"></i> No cumple
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- CORREGIDO: Verificación de rol para bloquear acciones al rol Invitado -->
                                    @if(auth()->user()?->role !== 'Invitado')
                                        <!-- CORREGIDO: Ajustado el parámetro a 'id' de acuerdo a tu routes/web.php -->
                                        <a href="{{ route('bonos.edit', ['id' => $bono->id_bono]) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i> Editar
                                        </a>
                                        
                                        <!-- CORREGIDO: Ajustado el parámetro a 'id' en el formulario seguro de eliminación -->
                                        <form action="{{ route('bonos.destroy', ['id' => $bono->id_bono]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este registro semanal? Esta acción no se puede deshacer.');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash-fill"></i> Borrar
                                            </button>
                                        </form>
                                    @else
                                        <!-- CORREGIDO: Ajustada la insignia con el estilo y tamaño unificado de 14px -->
                                        <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 14px;">
                                            <i class="bi bi-eye-fill"></i> Solo Lectura
                                        </span>
                                    @endif
                               </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle fs-4"></i> No hay registros de producción capturados en esta semana.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
