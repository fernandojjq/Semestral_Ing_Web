<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold text-slate-900 mb-1">Libro Diario</h2>
        <p class="text-muted mb-0">Registro y gestión de asientos contables.</p>
    </div>
    <div class="col-md-4 text-end">
        <span class="badge bg-light text-dark border">
            <i class="bi bi-calendar3 me-1"></i> <?php echo date('d M, Y'); ?>
        </span>
    </div>
</div>

<!-- Formulario de Nuevo Asiento -->
<div class="card mb-5 border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex align-items-center">
            <div class="bg-primary bg-opacity-10 text-primary rounded p-2 me-3">
                <i class="bi bi-pencil-square"></i>
            </div>
            <h5 class="mb-0 fw-bold text-slate-900">Nuevo Asiento Contable</h5>
        </div>
    </div>
    <div class="card-body p-4">
        <form action="app.php?view=diario&action=crear" method="POST" id="diario-form">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="fecha" class="form-label text-muted fw-bold small text-uppercase">Fecha de Operación
                        (Taller/Histórico)</label>
                    <input type="date" class="form-control form-control-lg" id="fecha" name="fecha"
                        value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'); ?>"
                        max="<?php echo date('Y-m-d'); ?>" required>
                    <div id="date-error" class="text-danger small mt-1" style="display:none">
                        <i class="bi bi-exclamation-circle-fill me-1"></i> No se permiten fechas futuras.
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="descripcion" class="form-label text-muted fw-bold small text-uppercase">Descripción del
                        Asiento</label>
                    <input type="text" class="form-control form-control-lg" id="descripcion" name="descripcion"
                        placeholder="Ej: Pago de nómina mensual"
                        value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : ''; ?>" required>
                </div>
            </div>

            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <div class="row g-3 mb-2 px-2">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold text-uppercase">Cuenta Contable</label>
                        </div>
                        <div class="col-md-3 text-end">
                            <label class="form-label text-muted small fw-bold text-uppercase">Debe</label>
                        </div>
                        <div class="col-md-3 text-end">
                            <label class="form-label text-muted small fw-bold text-uppercase">Haber</label>
                        </div>
                    </div>

                    <div id="detalles-container">
                        <!-- Fila 1 -->
                        <div class="row g-3 mb-3 detalle-row align-items-center">
                            <div class="col-md-6">
                                <select name="cuentas[]" class="form-select" required>
                                    <option value="">Seleccionar Cuenta...</option>
                                    <?php foreach ($catalogo as $cuenta): ?>
                                        <option value="<?php echo $cuenta['id']; ?>">
                                            <?php echo $cuenta['codigo'] . ' - ' . $cuenta['nombre']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 bg-white text-muted">$</span>
                                    <input type="number" step="0.01" name="debes[]"
                                        class="form-control border-start-0 text-end fw-bold" placeholder="0.00"
                                        value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 bg-white text-muted">$</span>
                                    <input type="number" step="0.01" name="haberes[]"
                                        class="form-control border-start-0 text-end fw-bold" placeholder="0.00"
                                        value="0">
                                </div>
                            </div>
                        </div>
                        <!-- Fila 2 -->
                        <div class="row g-3 mb-3 detalle-row align-items-center">
                            <div class="col-md-6">
                                <select name="cuentas[]" class="form-select" required>
                                    <option value="">Seleccionar Cuenta...</option>
                                    <?php foreach ($catalogo as $cuenta): ?>
                                        <option value="<?php echo $cuenta['id']; ?>">
                                            <?php echo $cuenta['codigo'] . ' - ' . $cuenta['nombre']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 bg-white text-muted">$</span>
                                    <input type="number" step="0.01" name="debes[]"
                                        class="form-control border-start-0 text-end fw-bold" placeholder="0.00"
                                        value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text border-end-0 bg-white text-muted">$</span>
                                    <input type="number" step="0.01" name="haberes[]"
                                        class="form-control border-start-0 text-end fw-bold" placeholder="0.00"
                                        value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="agregarFila()">
                            <i class="bi bi-plus-lg me-1"></i> Agregar Línea
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" id="btn-submit-diario" class="btn btn-success px-4 py-2 shadow-sm">
                    <i class="bi bi-check-lg me-2"></i>Registrar Asiento
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Cierre Gerencial -->
<?php if ($_SESSION['rol'] == 'gerente'): ?>
    <div class="card mb-5 border-warning shadow-sm" style="border-left-width: 4px;">
        <div class="card-body d-flex align-items-center justify-content-between p-4">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3 text-warning">
                    <i class="bi bi-shield-lock-fill fs-4"></i>
                </div>
                <div>
                    <h5 class="card-title text-dark fw-bold mb-1">Cierre de Mes</h5>
                    <p class="card-text text-muted small mb-0">Bloqueo de asientos y generación de firma digital.</p>
                </div>
            </div>
            <form action="app.php?view=diario&action=cerrar_mes" method="POST"
                class="d-flex align-items-center bg-white p-2 rounded border shadow-sm">
                <select name="mes" class="form-select form-select-sm w-auto me-2 border-0 fw-bold">
                    <?php for ($m = 1; $m <= 12; $m++): ?>
                        <option value="<?php echo $m; ?>" <?php echo $m == date('m') ? 'selected' : ''; ?>>Mes <?php echo $m; ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="btn btn-danger btn-sm px-3 rounded-pill fw-bold">Cerrar</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<!-- Listado de Asientos -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h5 class="mb-0 fw-bold text-slate-900">Historial de Transacciones</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Fecha</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th class="pe-4">Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($asientos as $asiento): ?>
                        <tr>
                            <td class="ps-4 text-muted small" style="white-space: nowrap;">
                                <i class="bi bi-calendar-event me-1"></i>
                                <?php echo date('d/m/Y', strtotime($asiento['fecha'])); ?>
                                <br>
                                <!-- Mostrar fecha de auditoría en tooltip o pequeño -->
                                <span class="text-xs ms-1 text-secondary"
                                    title="Fecha Auditoría: <?php echo $asiento['created_at']; ?>">
                                    <i class="bi bi-clock"></i>
                                    <?php echo date('H:i', strtotime($asiento['created_at'])); ?>
                                </span>
                            </td>
                            <td class="fw-bold text-dark"><?php echo $asiento['descripcion']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-1 me-2 text-muted">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <span class="small"><?php echo $asiento['usuario']; ?></span>
                                </div>
                            </td>
                            <td>
                                <?php if ($asiento['estado'] == 'cerrado'): ?>
                                    <span
                                        class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                        <i class="bi bi-lock-fill me-1"></i>CERRADO
                                    </span>
                                    <div class="text-muted mt-1 font-monospace" style="font-size: 0.65em;">
                                        Firma: <?php echo substr($asiento['firma_digital'], 0, 8); ?>...
                                    </div>
                                <?php else: ?>
                                    <span
                                        class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                        <i class="bi bi-unlock-fill me-1"></i>ABIERTO
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4">
                                <div class="bg-light rounded p-2 border">
                                    <table class="table table-sm table-borderless mb-0 small">
                                        <thead class="text-muted border-bottom">
                                            <tr>
                                                <th class="fw-normal" style="font-size: 0.75rem;">CUENTA</th>
                                                <th class="fw-normal" style="font-size: 0.75rem;">NOMBRE</th>
                                                <th class="text-end fw-normal" style="font-size: 0.75rem;">DEBE</th>
                                                <th class="text-end fw-normal" style="font-size: 0.75rem;">HABER</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $detalles = $model->obtenerDetalles($asiento['id']);
                                            foreach ($detalles as $d):
                                                ?>
                                                <tr>
                                                    <td class="text-muted"><?php echo $d['codigo']; ?></td>
                                                    <td class="text-truncate" style="max-width: 150px;">
                                                        <?php echo $d['cuenta']; ?>
                                                    </td>
                                                    <td class="text-end fw-bold text-success">
                                                        <?php echo $d['debe'] > 0 ? '$' . number_format($d['debe'], 2) : '-'; ?>
                                                    </td>
                                                    <td class="text-end fw-bold text-secondary">
                                                        <?php echo $d['haber'] > 0 ? '$' . number_format($d['haber'], 2) : '-'; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function agregarFila() {
        var container = document.getElementById('detalles-container');
        var row = container.querySelector('.detalle-row').cloneNode(true);

        row.querySelectorAll('input').forEach(input => input.value = '0');
        row.querySelectorAll('select').forEach(select => select.value = '');

        container.appendChild(row);
    }

    // Validación Dinámica de Fecha
    document.addEventListener('DOMContentLoaded', function () {
        const fechaInput = document.getElementById('fecha');
        const errorDiv = document.getElementById('date-error');
        const submitBtn = document.getElementById('btn-submit-diario');

        function validarFecha() {
            const fechaVal = fechaInput.value;
            if (!fechaVal) return;

            const selectedDate = new Date(fechaVal);
            const todayStr = new Date().toISOString().split('T')[0];

            if (fechaVal > todayStr) {
                // Fecha Futura
                errorDiv.style.display = 'block';
                fechaInput.classList.add('is-invalid');
                submitBtn.disabled = true;
            } else {
                // Fecha Válida
                errorDiv.style.display = 'none';
                fechaInput.classList.remove('is-invalid');
                submitBtn.disabled = false;
            }
        }

        // Listeners
        fechaInput.addEventListener('change', validarFecha);
        fechaInput.addEventListener('input', validarFecha);

        // Ejecutar al inicio por si viene sticky incorrecto
        validarFecha();
    });
</script>