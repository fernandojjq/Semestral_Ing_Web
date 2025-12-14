<?php
// public/index.php
define('BASE_PATH', dirname(__DIR__));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finanzas G7 - Sistema Financiero Corporativo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS with Cache Busting -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <style>
        /* Small inline adjustments for specific landing sections not in main style yet */
        .tech-pill {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50rem;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            margin: 0 0.5rem;
            backdrop-filter: blur(5px);
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
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
    <div class="hero d-flex align-items-center text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="display-3 fw-bold mb-4 text-white">Plataforma Integral de Gestión Financiera y Auditoría
                        Digital</h1>
                    <p class="lead text-white-50 mb-5 fs-4">Automatización de asientos contables mediante pasarela de
                        pagos y validación estricta de partida doble.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="app.php?view=login" class="btn btn-landing btn-lg shadow-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </a>
                        <a href="#modulos" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">
                            <i class="bi bi-book me-2"></i>Ver Documentación
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Módulos Clave Section -->
    <div id="modulos" class="container py-5 my-5">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-dark">Módulos Clave del Sistema</h2>
            <p class="text-muted lead">Arquitectura robusta diseñada para la integridad financiera</p>
        </div>

        <div class="row g-4">
            <!-- Módulo Contable -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <h3 class="h5 fw-bold mb-3 text-dark">Módulo Contable</h3>
                    <p class="text-muted small">Generación de Libro Diario con validación estricta NIIF. Garantía de
                        Principio de Partida Doble (Debe = Haber) en tiempo real.</p>
                </div>
            </div>

            <!-- Pasarela Inteligente -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-success bg-opacity-10 text-success">
                        <i class="bi bi-credit-card-2-front-fill"></i>
                    </div>
                    <h3 class="h5 fw-bold mb-3 text-dark">Pasarela Inteligente</h3>
                    <p class="text-muted small">Procesamiento de pagos que actúan como triggers automáticos para la
                        generación de asientos contables sin intervención manual.</p>
                </div>
            </div>

            <!-- Auditoría Forense -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h3 class="h5 fw-bold mb-3 text-dark">Auditoría Forense</h3>
                    <p class="text-muted small">Registro inmutable de doble fecha (Fecha Contable vs Fecha Real del
                        Servidor) para trazabilidad total de operaciones.</p>
                </div>
            </div>

            <!-- Cierre Gerencial -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-hover p-4 text-center">
                    <div class="feature-icon mx-auto mb-4 bg-indigo bg-opacity-10 text-indigo">
                        <i class="bi bi-pen-fill"></i>
                    </div>
                    <h3 class="h5 fw-bold mb-3 text-dark">Cierre Gerencial</h3>
                    <p class="text-muted small">Sistema de aprobación de ejercicios fiscales mediante Firma Digital y
                        Hashing criptográfico de estados financieros.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Tecnología -->
    <section class="py-5 bg-dark text-white">
        <div class="container text-center">
            <h3 class="h4 fw-bold mb-4 text-white opacity-75">Stack Tecnológico de Alto Rendimiento</h3>
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <span class="tech-pill"><i class="bi bi-code-slash me-2"></i>PHP 8 Nativo</span>
                <span class="tech-pill"><i class="bi bi-database-fill me-2"></i>MySQL 8</span>
                <span class="tech-pill"><i class="bi bi-layers-fill me-2"></i>Arquitectura MVC</span>
                <span class="tech-pill"><i class="bi bi-shield-shaded me-2"></i>Seguridad Bcrypt</span>
                <span class="tech-pill"><i class="bi bi-bootstrap-fill me-2"></i>Bootstrap 5</span>
            </div>
        </div>
    </section>

    <!-- Sobre el Equipo -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="p-5 rounded-4 bg-light shadow-sm border">
                    <h4 class="fw-bold text-dark mb-3">Proyecto Académico Semestral</h4>
                    <p class="text-muted mb-4">Facultad de Ingeniería de Sistemas Computacionales</p>
                    <div class="d-flex flex-wrap justify-content-center gap-4">
                        <div class="d-flex align-items-center">
                            <div class="step-number shadow-sm">F</div>
                            <span class="ms-2 fw-semibold">Fernando</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="step-number shadow-sm bg-primary">B</div>
                            <span class="ms-2 fw-semibold">Bryan</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="step-number shadow-sm bg-indigo">E</div>
                            <span class="ms-2 fw-semibold">Evaristo</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="step-number shadow-sm bg-dark">D</div>
                            <span class="ms-2 fw-semibold">Diego</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto border-top border-secondary">
        <div class="container text-center">
            <p class="mb-0 small opacity-75">&copy; 2025 Finanzas G7. Desarrollado para el Examen Semestral de
                Ingeniería Web.</p>
        </div>
    </footer>

</body>

</html>