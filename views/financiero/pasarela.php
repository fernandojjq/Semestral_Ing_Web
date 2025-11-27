<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-slate-900">Pasarela de Pago</h2>
                <p class="text-muted">Procesamiento seguro de transacciones.</p>
            </div>

            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3 text-primary">
                        <i class="bi bi-credit-card-2-front fs-1"></i>
                    </div>
                    <h5 class="fw-bold text-slate-900">Detalles de la Transacción</h5>
                </div>
                <div class="card-body p-4">
                    <form action="app.php?view=pasarela&action=pagar" method="POST" id="payment-form">
                        <!-- Concepto -->
                        <div class="mb-3">
                            <label for="concepto"
                                class="form-label text-muted small fw-bold text-uppercase">Concepto</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-receipt text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" id="concepto"
                                    name="concepto" placeholder="Ej: Factura F-2025-001" required>
                            </div>
                        </div>

                        <!-- Monto -->
                        <div class="mb-3">
                            <label for="monto" class="form-label text-muted small fw-bold text-uppercase">Monto</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-end-0 text-success fw-bold">$</span>
                                <input type="number" step="0.01" min="0.01"
                                    class="form-control border-start-0 ps-0 fw-bold text-success" id="monto"
                                    name="monto" placeholder="0.00" required>
                            </div>
                        </div>

                        <!-- Método de Pago -->
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase mb-2">Método de
                                Pago</label>
                            <div class="d-grid gap-2">
                                <label class="card p-3 border cursor-pointer method-card selected-method"
                                    onclick="selectMethod('tarjeta')">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metodo" id="tarjeta"
                                                value="tarjeta" checked>
                                        </div>
                                        <div class="ms-3">
                                            <span class="fw-bold d-block text-slate-900">Tarjeta de Crédito</span>
                                        </div>
                                        <div class="ms-auto text-muted"><i class="bi bi-credit-card fs-5"></i></div>
                                    </div>
                                </label>

                                <label class="card p-3 border cursor-pointer method-card"
                                    onclick="selectMethod('transferencia')">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metodo"
                                                id="transferencia" value="transferencia">
                                        </div>
                                        <div class="ms-3">
                                            <span class="fw-bold d-block text-slate-900">Transferencia ACH</span>
                                        </div>
                                        <div class="ms-auto text-muted"><i class="bi bi-bank fs-5"></i></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Dynamic Fields -->
                        <div id="payment-fields-container">
                            <!-- Card Fields -->
                            <div id="card-fields">
                                <div class="mb-3">
                                    <label for="card_number"
                                        class="form-label text-muted small fw-bold text-uppercase">Número de
                                        Tarjeta</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i
                                                class="bi bi-credit-card-2-front text-muted"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" id="card_number"
                                            name="card_number" placeholder="0000 0000 0000 0000" maxlength="19">
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label for="card_expiry"
                                            class="form-label text-muted small fw-bold text-uppercase">Vencimiento</label>
                                        <input type="text" class="form-control" id="card_expiry" name="card_expiry"
                                            placeholder="MM/YY" maxlength="5">
                                    </div>
                                    <div class="col-6">
                                        <label for="card_cvv"
                                            class="form-label text-muted small fw-bold text-uppercase">CVV</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-end-0" id="card_cvv"
                                                name="card_cvv" placeholder="123" maxlength="3">
                                            <span class="input-group-text bg-white border-start-0"><i
                                                    class="bi bi-shield-lock text-muted"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ACH Fields -->
                            <div id="ach-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="referencia_pago"
                                        class="form-label text-muted small fw-bold text-uppercase">Número de
                                        Referencia</label>
                                    <input type="text" class="form-control" id="referencia_pago" name="referencia_pago"
                                        placeholder="Ej: ACH-12345678">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg py-3 rounded-pill shadow-sm fw-bold">
                                <i class="bi bi-lock-fill me-2"></i>Pagar Ahora
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-muted text-center py-3 border-0 small">
                    <i class="bi bi-shield-check text-success me-1"></i> Pago 100% Seguro y Encriptado
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .method-card {
        transition: all 0.2s;
    }

    .method-card:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .method-card.selected-method {
        border-color: var(--bs-primary) !important;
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>

<script>
    function selectMethod(method) {
        // Visual Update
        document.querySelectorAll('.method-card').forEach(c => c.classList.remove('selected-method'));
        const radio = document.getElementById(method);
        if (radio) {
            radio.checked = true;
            radio.closest('.method-card').classList.add('selected-method');
        }

        // Toggle Fields
        const cardFields = document.getElementById('card-fields');
        const achFields = document.getElementById('ach-fields');
        const cardInputs = cardFields.querySelectorAll('input');
        const achInput = document.getElementById('referencia_pago');

        if (method === 'tarjeta') {
            cardFields.style.display = 'block';
            achFields.style.display = 'none';
            cardInputs.forEach(i => i.required = true);
            achInput.required = false;
        } else {
            cardFields.style.display = 'none';
            achFields.style.display = 'block';
            cardInputs.forEach(i => i.required = false);
            achInput.required = true;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const cardNumber = document.getElementById('card_number');
        const cardExpiry = document.getElementById('card_expiry');
        const cardCvv = document.getElementById('card_cvv');
        const form = document.getElementById('payment-form');

        // Masking
        cardNumber.addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g, '').substring(0, 16);
            e.target.value = v.match(/.{1,4}/g)?.join(' ') || v;
        });

        cardExpiry.addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length >= 2) v = v.substring(0, 2) + '/' + v.substring(2, 4);
            e.target.value = v;
        });

        cardCvv.addEventListener('input', e => {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

        // Form Validation
        form.addEventListener('submit', function (e) {
            const monto = parseFloat(document.getElementById('monto').value);
            const metodo = document.querySelector('input[name="metodo"]:checked').value;

            // 1. Validar Monto
            if (isNaN(monto) || monto <= 0) {
                e.preventDefault();
                alert("El monto debe ser mayor a cero.");
                return;
            }

            // 2. Validar Tarjeta Vencida
            if (metodo === 'tarjeta') {
                const expiryValue = cardExpiry.value; // MM/YY
                if (!/^\d{2}\/\d{2}$/.test(expiryValue)) {
                    e.preventDefault();
                    alert("Formato de fecha inválido. Use MM/YY.");
                    return;
                }

                const parts = expiryValue.split('/');
                const expMonth = parseInt(parts[0], 10);
                const expYear = parseInt(parts[1], 10) + 2000; // Asumimos siglo 21

                const now = new Date();
                const currentMonth = now.getMonth() + 1; // 0-indexed
                const currentYear = now.getFullYear();

                if (expYear < currentYear || (expYear === currentYear && expMonth < currentMonth)) {
                    e.preventDefault();
                    alert("La tarjeta está vencida.");
                    return;
                }
            }
        });

        // Init
        selectMethod('tarjeta');
    });
</script>