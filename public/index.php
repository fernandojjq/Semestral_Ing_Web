<?php
// public/index.php
define('BASE_PATH', dirname(__DIR__));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finanzas G7 - Sistema Financiero</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS with Cache Busting -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-bank2 me-2"></i>Finanzas G7
            </a>
            <div class="ms-auto">
                <a href="app.php?view=login" class="btn btn-outline-light btn-sm rounded-pill px-4 fw-bold">Iniciar
                    Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-4 text-white">Control Financiero Inteligente</h1>
                    <p class="lead text-white-50 mb-5">La plataforma integral para la gestión contable, auditoría y toma
                        de decisiones estratégicas de su empresa.</p>
                    <a href="app.php?view=login" class="btn btn-landing btn-lg shadow-lg">
                        Acceder al Sistema <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5 my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3 text-dark">Control Total</h3>
                    <p class="text-muted">Monitoreo en tiempo real de activos, pasivos y patrimonio con precisión
                        milimétrica.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-success bg-opacity-10 text-success">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3 text-dark">Transparencia</h3>
                    <p class="text-muted">Registros inmutables y auditoría completa de todas las transacciones
                        financieras.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-indigo bg-opacity-10 text-indigo">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3 text-dark">Eficiencia</h3>
                    <p class="text-muted">Automatización de procesos contables y generación de reportes instantáneos.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0 small opacity-75">&copy; 2025 Grupo 7 - Ingeniería Web. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>