@extends('layouts.app')

@section('contenido')

<div class="mb-4">
    <h1 style="font-weight:bold;">
        <i class="bi bi-bar-chart-fill"></i>
        Reportes del Sistema
    </h1>
    <p class="text-muted">
        Consulta información contable en tiempo real cruzando datos de pedidos, pagos y bonos.
    </p>
</div>

<!-- FILTROS REALES DIRECTO A MYSQL -->
<div class="card shadow-sm border-0 mb-4" style="border-radius: 15px; background: #ffffff;">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-funnel-fill" style="color: #c89b3c;"></i> Consultar Período Contable</h5>
        <form action="/reportes" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="tipo_filtro" class="form-label fw-bold">Filtrar por:</label>
                <select name="tipo_filter" id="tipo_filtro" class="form-select" onchange="alternarInputsFiltroReal()">
                    <option value="todos" {{ $tipoFiltro == 'todos' ? 'selected' : '' }}>Mostrar Todo (Histórico)</option>
                    <option value="dia" {{ $tipoFiltro == 'dia' ? 'selected' : '' }}>Día Específico</option>
                    <option value="mes" {{ $tipoFiltro == 'mes' ? 'selected' : '' }}>Por Mes</option>
                    <option value="ano" {{ $tipoFiltro == 'ano' ? 'selected' : '' }}>Por Año</option>
                </select>
                <!-- Input oculto corregido para enviar el valor real sin romper la petición -->
                <input type="hidden" name="tipo_filtro" id="tipo_filtro_oculto" value="{{ $tipoFiltro }}">
            </div>
            
            <div class="col-md-5 contenedor-filtro-real" id="boxDia" style="display: none;">
                <label class="form-label fw-bold">Seleccionar Día</label>
                <input type="date" name="fecha_dia" class="form-control" value="{{ $fechaDia }}">
            </div>

            <div class="col-md-5 contenedor-filtro-real" id="boxMes" style="display: none;">
                <label class="form-label fw-bold">Seleccionar Mes</label>
                <input type="month" name="fecha_mes" class="form-control" value="{{ $fechaMes }}">
            </div>

            <div class="col-md-5 contenedor-filtro-real" id="boxAno" style="display: none;">
                <label class="form-label fw-bold">Escribir Año</label>
                <input type="number" name="fecha_ano" class="form-control" min="2000" max="2099" value="{{ $fechaAno }}">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-warning w-100 fw-bold" style="border-radius: 8px; color: #0b0b0b; background-color: #c89b3c; border-color: #c89b3c;">
                    <i class="bi bi-search"></i> Calcular Reporte
                </button>
            </div>
        </form>
    </div>
</div>

<!-- RESUMEN DE GANANCIA NETA DEL PERÍODO FILTRADO -->
<div class="card shadow-sm border-0 mb-5 text-center" style="border-radius: 15px; border-bottom: 4px solid #c89b3c; background: #ffffff;">
    <div class="card-body p-4">
        <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 1px;">
            <i class="bi bi-trophy-fill" style="color: #c89b3c;"></i> 
            Ganancia Neta del Período Seleccionado (Ingresos menos Gastos)
        </small>
        <h1 class="fw-bold mt-2 {{ $gananciaNetaTotal >= 0 ? 'text-success' : 'text-danger' }}" style="font-size: 2.8rem;">
            ${{ number_format($gananciaNetaTotal, 2) }}
        </h1>
        <span class="badge bg-light text-dark border uppercase">Filtro Activo: {{ strtoupper($tipoFiltro) }}</span>
    </div>
</div>

<!-- SECCIONES DE COMPARATIVA FINANCIERA -->
<div class="row g-4">
    <!-- PANEL DE VENTAS (Órdenes Totales) -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 p-3" style="border-radius: 12px;">
            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2"><i class="bi bi-cart-fill text-warning"></i> Control de Ventas</h5>
            <div class="bg-light p-3 rounded mb-3 text-center" style="border-left: 4px solid #c89b3c;">
                <small class="text-muted d-block fw-bold">VENTAS DEL FILTRO</small>
                <span class="fs-3 fw-bold text-dark">${{ number_format($ventasFiltradas, 2) }}</span>
            </div>
            <div class="small text-secondary">
                <div class="d-flex justify-content-between mb-1"><span>Hoy:</span> <span class="fw-bold">${{ number_format($ventasHoy, 2) }}</span></div>
                <div class="d-flex justify-content-between mb-1"><span>Esta Semana:</span> <span class="fw-bold">${{ number_format($ventasSemana, 2) }}</span></div>
                <div class="d-flex justify-content-between mb-1"><span>Este Mes:</span> <span class="fw-bold">${{ number_format($ventasMes, 2) }}</span></div>
                <div class="d-flex justify-content-between"><span>Este Año:</span> <span class="fw-bold">${{ number_format($ventasAno, 2) }}</span></div>
            </div>
        </div>
    </div>

    <!-- PANEL DE GASTOS (Incentivos y Bonos) -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 p-3" style="border-radius: 12px;">
            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2"><i class="bi bi-dash-circle-fill text-danger"></i> Control de Gastos</h5>
            <div class="bg-light p-3 rounded mb-3 text-center" style="border-left: 4px solid #dc3545;">
                <small class="text-muted d-block fw-bold">GASTOS DEL FILTRO</small>
                <span class="fs-3 fw-bold text-dark">${{ number_format($gastosFiltrados, 2) }}</span>
            </div>
            <div class="small text-secondary">
                <div class="d-flex justify-content-between mb-2"><span>Esta Semana:</span> <span class="fw-bold">${{ number_format($gastosSemana, 2) }}</span></div>
                <div class="d-flex justify-content-between mb-2"><span>Este Mes:</span> <span class="fw-bold">${{ number_format($gastosMes, 2) }}</span></div>
                <div class="d-flex justify-content-between"><span>Este Año:</span> <span class="fw-bold">${{ number_format($gastosAno, 2) }}</span></div>
            </div>
        </div>
    </div>

    <!-- PANEL DE GANANCIAS (Monto Real Cobrado) -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 p-3" style="border-radius: 12px;">
            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2"><i class="bi bi-graph-up-arrow text-success"></i> Dinero Recaudado</h5>
            <div class="bg-light p-3 rounded mb-3 text-center" style="border-left: 4px solid #198754;">
                <small class="text-muted d-block fw-bold">RECAUDADO DEL FILTRO</small>
                <span class="fs-3 fw-bold text-dark">${{ number_format($gananciasFiltradas, 2) }}</span>
            </div>
            <div class="small text-secondary">
                <div class="d-flex justify-content-between mb-2"><span>Esta Semana:</span> <span class="fw-bold">${{ number_format($gananciaSemana, 2) }}</span></div>
                <div class="d-flex justify-content-between mb-2"><span>Este Mes:</span> <span class="fw-bold">${{ number_format($gananciaMes, 2) }}</span></div>
                <div class="d-flex justify-content-between"><span>Este Año:</span> <span class="fw-bold">${{ number_format($gananciaAno, 2) }}</span></div>
            </div>
        </div>
    </div>
</div>

<!-- MANEJO VISUAL DE CONEXIÓN DE FILTROS -->
<script>
    function alternarInputsFiltroReal() {
        const select = document.getElementById('tipo_filtro');
        const tipo = select.value;
        
        // Sincronizamos el input oculto
        document.getElementById('tipo_filtro_oculto').value = tipo;
        
        // Ocultamos las tres casillas
        document.querySelectorAll('.contenedor-filtro-real').forEach(el => el.style.display = 'none');
        
        // Mostramos el bloque que corresponde al tipo seleccionado
        if (tipo === 'dia') document.getElementById('boxDia').style.display = 'block';
        if (tipo === 'mes') document.getElementById('boxMes').style.display = 'block';
        if (tipo === 'ano') document.getElementById('boxAno').style.display = 'block';
    }

    // Ejecutamos al cargar la página para conservar la casilla abierta después de recargar
    document.addEventListener("DOMContentLoaded", function() {
        alternarInputsFiltroReal();
    });
</script>

@endsection
