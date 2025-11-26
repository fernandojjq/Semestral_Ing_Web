<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-slate-900">Pasarela de Pago</h2>
            <p class="text-muted">Procesamiento seguro de transacciones financieras.</p>
        </div>

        <div class="card shadow-lg border-0 overflow-hidden">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3 text-primary">
                    <i class="bi bi-credit-card-2-front fs-1"></i>
                </div>
                <h5 class="fw-bold text-slate-900">Detalles de la Transacción</h5>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="app.php?view=pasarela&action=pagar" method="POST">
                    <div class="mb-4">
                        <label for="concepto" class="form-label text-muted small fw-bold text-uppercase">Concepto /
                            Factura</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i
                                    class="bi bi-receipt text-muted"></i></span>
                            <input type="text" class="form-control form-control-lg border-start-0 ps-0" id="concepto"
                                name="concepto" placeholder="Ej: Factura F-2025-001" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="monto" class="form-label text-muted small fw-bold text-uppercase">Monto a
                            Pagar</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0 text-success fw-bold">$</span>
                            <input type="number" step="0.01"
                                class="form-control border-start-0 ps-0 fw-bold text-success" style="font-size: 2rem;"
                                id="monto" name="monto" placeholder="0.00" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold text-uppercase mb-3">Método de Pago</label>
                        <div class="d-grid gap-3">
                            <label class="card p-3 border cursor-pointer method-card selected-method"
                                onclick="selectMethod('tarjeta')">
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="metodo" id="tarjeta"
                                            value="tarjeta" checked>
                                    </div>
                                    <div class="ms-3">
                                        <span class="fw-bold d-block text-slate-900">Tarjeta de Crédito / Débito</span>
                                        <span class="text-muted small">Visa, Mastercard, Amex</span>
                                    </div>
                                    <div class="ms-auto text-muted">
                                        <i class="bi bi-credit-card fs-4"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="card p-3 border cursor-pointer method-card"
                                onclick="selectMethod('transferencia')">
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="metodo" id="transferencia"
                                            value="transferencia">
                                    </div>
                                    <div class="ms-3">
                                        <span class="fw-bold d-block text-slate-900">Transferencia Bancaria (ACH)</span>
                                        <span class="text-muted small">Directo a cuenta corriente</span>
                                    </div>
                                    <div class="ms-auto text-muted">
                                        <i class="bi bi-bank fs-4"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Dynamic Input for Reference -->
                    <div class="mb-4">
                        <label for="referencia_pago" class="form-label text-muted small fw-bold text-uppercase">Datos de
                            Pago</label>
                        <input type="text" class="form-control form-control-lg" id="referencia_pago"
                            name="referencia_pago" placeholder="Número de Tarjeta (0000-0000-0000-0000)" required>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button type="submit" class="btn btn-success btn-lg py-3 rounded-pill shadow-sm fw-bold">
                            <i class="bi bi-lock-fill me-2"></i>Procesar Pago Seguro
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light text-muted text-center py-3 border-0 small">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                    <i class="bi bi-shield-check text-success fs-5"></i>
                    <span class="fw-bold text-slate-900">Pago 100% Seguro</span>
                </div>
                <p class="mb-0">Sus datos están encriptados. Se generará el asiento contable automáticamente.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .method-card {
        transition: all 0.2s;
        cursor: pointer;
    }

    .method-card:hover {
        border-color: var(--accent-color);
        background-color: #f0fdf4;
    }

    .method-card.selected-method {
        border-color: var(--accent-color);
        background-color: #ecfdf5;
        box-shadow: 0 0 0 1px var(--accent-color);
    }
</style>

<script>
    function selectMethod(method) {
        // Visual selection logic
        document.querySelectorAll('.method-card').forEach(el => el.classList.remove('selected-method'));
        document.getElementById(method).closest('.method-card').classList.add('selected-method');
        document.getElementById(method).checked = true;

        // Placeholder logic
        const input = document.getElementById('referencia_pago');
        if (method === 'tarjeta') {
            input.placeholder = "Número de Tarjeta (0000-0000-0000-0000)";
        } else {
            input.placeholder = "Número de Confirmación ACH";
        }
    }
</script>