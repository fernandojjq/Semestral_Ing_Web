<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold text-dark mb-0">Dashboard Financiero</h2>
        <p class="text-muted mb-0">Resumen ejecutivo de la situación financiera.</p>
    </div>
    <div class="col-md-4 text-end">
        <span class="badge bg-white text-dark border shadow-sm p-2">
            <i class="bi bi-calendar-event me-1"></i> <?php echo date('d M, Y'); ?>
        </span>
    </div>
</div>

<div class="row g-4">
    <!-- Balance General Widget -->
    <div class="col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white border-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary mb-0"><i class="bi bi-scale me-2"></i>Balance General</h5>
                <span class="badge bg-light text-primary rounded-pill">Al día</span>
            </div>
            <div class="card-body px-4 pt-3">
                <div class="row g-3 mt-2">
                    <div class="col-12">
                        <div class="p-3 rounded-3 bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted fw-bold d-block">ACTIVOS</small>
                                <span
                                    class="h4 fw-bold text-success mb-0">$<?php echo number_format($balance['Activo'], 2); ?></span>
                            </div>
                            <i class="bi bi-graph-up-arrow text-success fs-3"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-light">
                            <small class="text-muted fw-bold d-block">PASIVOS</small>
                            <span
                                class="h5 fw-bold text-danger mb-0">$<?php echo number_format($balance['Pasivo'], 2); ?></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3 bg-light">
                            <small class="text-muted fw-bold d-block">CAPITAL</small>
                            <span
                                class="h5 fw-bold text-primary mb-0">$<?php echo number_format($balance['Capital'], 2); ?></span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <small class="text-muted fst-italic"><i class="bi bi-info-circle me-1"></i> Ecuación: Activo =
                        Pasivo + Capital</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado de Resultados Widget -->
    <div class="col-md-6">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-header bg-white border-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-primary mb-0"><i class="bi bi-file-earmark-bar-graph me-2"></i>Estado de
                    Resultados</h5>
                <span class="badge bg-light text-primary rounded-pill">Ejercicio Actual</span>
            </div>
            <div class="card-body px-4 pt-3 text-center d-flex flex-column justify-content-center">
                <div class="py-4">
                    <small class="text-muted fw-bold text-uppercase tracking-wide">Utilidad / Pérdida Neta</small>
                    <h1
                        class="display-4 fw-bold <?php echo $estadoResultados >= 0 ? 'text-success' : 'text-danger'; ?> my-3">
                        $<?php echo number_format($estadoResultados, 2); ?>
                    </h1>
                    <p class="text-muted mb-4">Resultado acumulado del periodo operativo.</p>
                </div>
                <a href="app.php?view=diario" class="btn btn-outline-primary rounded-pill w-100 mt-auto">
                    <i class="bi bi-journal-text me-2"></i>Ver Detalles en Libro Diario
                </a>
            </div>
        </div>
    </div>
</div>