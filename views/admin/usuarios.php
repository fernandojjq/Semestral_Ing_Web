<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold text-slate-900 mb-1">Gestión de Usuarios</h2>
        <p class="text-muted mb-0">Administración de accesos y roles del sistema.</p>
    </div>
    <div class="col-md-4 text-end">
        <button type="button" class="btn btn-primary rounded-pill shadow-sm px-4" data-bs-toggle="modal"
            data-bs-target="#modalUsuario">
            <i class="bi bi-person-plus-fill me-2"></i>Nuevo Usuario
        </button>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#<?php echo $u['id']; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <span class="fw-bold text-slate-900"><?php echo $u['nombre']; ?></span>
                                </div>
                            </td>
                            <td class="text-muted"><?php echo $u['email']; ?></td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill px-3">
                                    <?php echo ucfirst($u['rol']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($u['activo']): ?>
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-check-circle-fill me-1"></i>Activo
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger rounded-pill">
                                        <i class="bi bi-x-circle-fill me-1"></i>Inactivo
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-start"
                                        onclick="editarUsuario(<?php echo $u['id']; ?>, '<?php echo $u['nombre']; ?>', '<?php echo $u['email']; ?>', '<?php echo $u['rol']; ?>')"
                                        title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <?php if ($u['activo']): ?>
                                        <a href="app.php?view=usuarios&action=cambiar_estado&id=<?php echo $u['id']; ?>&estado=0"
                                            class="btn btn-sm btn-outline-warning rounded-end" title="Desactivar">
                                            <i class="bi bi-pause-circle"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="app.php?view=usuarios&action=cambiar_estado&id=<?php echo $u['id']; ?>&estado=1"
                                            class="btn btn-sm btn-outline-success rounded-end" title="Activar">
                                            <i class="bi bi-play-circle"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear Usuario -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-slate-900">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app.php?view=usuarios&action=crear" method="POST">
                <div class="modal-body pt-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan Pérez" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="juan@empresa.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Rol</label>
                        <select name="rol" class="form-select" required>
                            <option value="contador">Contador</option>
                            <option value="gerente">Gerente</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-slate-900">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app.php?view=usuarios&action=editar" method="POST">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body pt-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Nombre Completo</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Contraseña (Opcional)</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="Dejar en blanco para mantener actual">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold text-uppercase">Rol</label>
                        <select name="rol" id="edit_rol" class="form-select" required>
                            <option value="contador">Contador</option>
                            <option value="gerente">Gerente</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Actualizar Datos</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editarUsuario(id, nombre, email, rol) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_rol').value = rol;

        var myModal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
        myModal.show();
    }
</script>