<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Financiero</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0f172a;
            --accent-color: #10b981;
            --bg-color: #f1f5f9;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 400px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.8rem;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #1e293b;
        }

        .form-control {
            padding: 0.8rem;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
    </style>
</head>

<body>
    <main class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-wallet2 display-4 text-primary"></i>
            <h1 class="h3 mt-3 fw-bold text-dark">Bienvenido</h1>
            <p class="text-muted">Ingresa tus credenciales para continuar</p>
        </div>

        <form action="app.php?view=login&action=auth" method="POST">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div><?php echo $error; ?></div>
                </div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com"
                    required>
                <label for="floatingInput">Correo Electrónico</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
                    required>
                <label for="floatingPassword">Contraseña</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary rounded-pill mb-3" type="submit">
                Ingresar al Sistema
            </button>
            <p class="mt-4 mb-0 text-muted text-center small">&copy; 2025 Grupo 7 - Ingeniería Web</p>
        </form>
    </main>
</body>

</html>