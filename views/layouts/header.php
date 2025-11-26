<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Financiero</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="app-body">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="app.php">
                <i class="bi bi-bank2 me-2"></i>Finanzas G7
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExampleDefault">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="app.php?view=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="app.php?view=diario">Libro Diario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="app.php?view=pasarela">Pasarela</a>
                    </li>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="app.php?view=usuarios">Usuarios</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-md-block">
                        <div class="text-white fw-bold small mb-0">
                            <?php echo $_SESSION['nombre'] ?? 'Usuario'; ?>
                        </div>
                        <div class="text-muted small" style="font-size: 0.75rem;">
                            <?php echo strtoupper($_SESSION['rol'] ?? 'Invitado'); ?>
                        </div>
                    </div>
                    <div class="vr text-secondary d-none d-md-block"></div>
                    <a href="app.php?view=logout" class="btn btn-outline-secondary btn-sm border-0 text-white">
                        <i class="bi bi-box-arrow-right fs-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4 shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div><?php echo $error; ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show mt-4 shadow-sm border-0" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div><?php echo $success; ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>