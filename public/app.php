<?php
// public/app.php
session_start();
define('BASE_PATH', dirname(__DIR__));

// Autoload simple
spl_autoload_register(function ($class) {
    $prefix = 'Src\\';
    $base_dir = BASE_PATH . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Intenta cargar Config
        if (strncmp('Config\\', $class, 7) === 0) {
            $file = BASE_PATH . '/config/' . substr($class, 7) . '.php';
            if (file_exists($file))
                require $file;
            return;
        }
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use Src\Clases\Auth;
use Src\Models\DiarioModel;
use Src\Models\ReportesModel;
use Src\Models\UserModel;
use Src\Clases\Sanitizar;

// Router Simple
$view = isset($_GET['view']) ? $_GET['view'] : 'dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Rutas Públicas
if ($view == 'login') {
    if ($action == 'auth') {
        $auth = new Auth();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = $auth->login($email, $password);
        if ($result === true) {
            header("Location: app.php?view=dashboard");
            exit;
        } else {
            $error = $result;
            include BASE_PATH . '/views/auth/login.php';
            exit;
        }
    }
    include BASE_PATH . '/views/auth/login.php';
    exit;
}

// Rutas Protegidas
if (!isset($_SESSION['user_id'])) {
    header("Location: app.php?view=login");
    exit;
}

if ($view == 'logout') {
    Auth::logout();
}

// Controlador Frontal
switch ($view) {
    case 'dashboard':
        $reportes = new ReportesModel();
        $balance = $reportes->getBalanceGeneral();
        $estadoResultados = $reportes->getEstadoResultados();
        include BASE_PATH . '/views/layouts/header.php';
        include BASE_PATH . '/views/admin/dashboard.php';
        break;

    case 'diario':
        $model = new DiarioModel();

        if ($action == 'crear') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $descripcion = Sanitizar::limpiar($_POST['descripcion']);
                    $detalles = [];
                    // Procesar detalles del formulario (asumiendo arrays en POST)
                    // Ejemplo: cuentas[], debes[], haberes[]
                    if (isset($_POST['cuentas'])) {
                        for ($i = 0; $i < count($_POST['cuentas']); $i++) {
                            if (!empty($_POST['cuentas'][$i])) {
                                $detalles[] = [
                                    'cuenta_id' => $_POST['cuentas'][$i],
                                    'debe' => (float) $_POST['debes'][$i],
                                    'haber' => (float) $_POST['haberes'][$i]
                                ];
                            }
                        }
                    }

                    $model->crearAsiento($_SESSION['user_id'], $descripcion, $detalles);
                    $success = "Asiento creado correctamente.";
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }

        // Cierre Gerencial
        if ($action == 'cerrar_mes' && $_SESSION['rol'] == 'gerente') {
            $mes = $_POST['mes'] ?? date('m');
            $cerrados = $model->cierreGerencial($mes, $_SESSION['user_id']);
            if ($cerrados !== false) {
                $success = "Se cerraron $cerrados asientos del mes $mes.";
            } else {
                $error = "No se pudieron cerrar los asientos.";
            }
        }

        $asientos = $model->obtenerAsientos();
        $catalogo = (new ReportesModel())->getCatalogo();
        include BASE_PATH . '/views/layouts/header.php';
        include BASE_PATH . '/views/financiero/diario.php';
        break;

    case 'pasarela':
        if ($action == 'pagar') {
            try {
                $monto = (float) $_POST['monto'];
                $concepto = Sanitizar::limpiar($_POST['concepto']);
                $metodo = $_POST['metodo'] ?? 'tarjeta';
                $descripcion_asiento = "Pago Pasarela: $concepto";

                // Validaciones Estrictas
                if ($monto <= 0) {
                    throw new Exception("El monto debe ser mayor a cero.");
                }

                if ($metodo == 'tarjeta') {
                    $cardNumber = str_replace(' ', '', $_POST['card_number'] ?? '');
                    $cardExpiry = $_POST['card_expiry'] ?? '';
                    $cardCvv = $_POST['card_cvv'] ?? '';

                    // 1. Validar 16 dígitos
                    if (!preg_match('/^\d{16}$/', $cardNumber)) {
                        throw new Exception("El número de tarjeta debe tener 16 dígitos exactos.");
                    }
                    // 2. Validar CVV (3 dígitos)
                    if (!preg_match('/^\d{3}$/', $cardCvv)) {
                        throw new Exception("El CVV debe tener 3 dígitos.");
                    }
                    // 3. Validar Expiración (MM/YY)
                    if (!preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $cardExpiry)) {
                        throw new Exception("Fecha de vencimiento inválida. Formato MM/YY.");
                    }

                    // Validar que no esté vencida
                    $parts = explode('/', $cardExpiry);
                    $expMonth = (int) $parts[0];
                    $expYear = (int) $parts[1] + 2000;
                    $currentYear = (int) date('Y');
                    $currentMonth = (int) date('m');

                    if ($expYear < $currentYear || ($expYear == $currentYear && $expMonth < $currentMonth)) {
                        throw new Exception("La tarjeta está vencida.");
                    }

                    // Enmascarar para descripción
                    $maskedCard = substr($cardNumber, 0, 4) . ' **** **** ' . substr($cardNumber, -4);
                    $descripcion_asiento .= " (Tarjeta: $maskedCard)";

                } elseif ($metodo == 'transferencia') {
                    $referencia = Sanitizar::limpiar($_POST['referencia_pago'] ?? '');

                    // Validar Referencia (6-20 caracteres)
                    if (strlen($referencia) < 6 || strlen($referencia) > 20) {
                        throw new Exception("El número de referencia debe tener entre 6 y 20 caracteres.");
                    }

                    $descripcion_asiento .= " (Ref ACH: $referencia)";
                }

                // Simular Pago Exitoso
                // Crear Asiento Automático
                // Debita Banco (102), Acredita Ingresos (401)
                $detalles = [
                    ['cuenta_id' => 3, 'debe' => $monto, 'haber' => 0], // Banco
                    ['cuenta_id' => 9, 'debe' => 0, 'haber' => $monto]  // Ventas
                ];

                $diarioModel = new DiarioModel();
                $asientoId = $diarioModel->crearAsiento($_SESSION['user_id'], $descripcion_asiento, $detalles);

                // Guardar transacción pasarela
                $conn = (new \Config\Conexion())->getConnection();
                $stmt = $conn->prepare("INSERT INTO transacciones_pasarela (monto, concepto, asiento_id) VALUES (?, ?, ?)");
                $stmt->execute([$monto, $concepto, $asientoId]);

                $success = "Pago procesado con éxito. Asiento #$asientoId generado automáticamente.";
            } catch (Exception $e) {
                $error = "Error en el pago: " . $e->getMessage();
            }
        }
        include BASE_PATH . '/views/layouts/header.php';
        include BASE_PATH . '/views/financiero/pasarela.php';
        break;

    case 'usuarios':
        if ($_SESSION['rol'] !== 'admin') {
            header("Location: app.php?view=dashboard");
            exit;
        }

        $userModel = new UserModel();

        if ($action == 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nombre = Sanitizar::limpiar($_POST['nombre']);
                $email = Sanitizar::limpiar($_POST['email']);
                $password = $_POST['password'];
                $rol = $_POST['rol'];

                if (strlen($password) < 8) {
                    $error = "La contraseña debe tener al menos 8 caracteres.";
                } elseif ($userModel->existeEmail($email)) {
                    $error = "El email ya está registrado.";
                } else {
                    if ($userModel->crear($nombre, $email, $password, $rol)) {
                        $success = "Usuario creado correctamente.";
                    } else {
                        $error = "Error al crear usuario.";
                    }
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        // Lógica para EDITAR usuario
        if ($action == 'editar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id = $_POST['id'];
                $nombre = Sanitizar::limpiar($_POST['nombre']);
                $email = Sanitizar::limpiar($_POST['email']);
                $rol = $_POST['rol'];
                $password = !empty($_POST['password']) ? $_POST['password'] : null;

                if ($password && strlen($password) < 8) {
                    $error = "La contraseña debe tener al menos 8 caracteres.";
                } elseif ($userModel->actualizar($id, $nombre, $email, $rol, $password)) {
                    $success = "Usuario actualizado correctamente.";
                } else {
                    $error = "Error al actualizar usuario.";
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        if ($action == 'cambiar_estado' && isset($_GET['id']) && isset($_GET['estado'])) {
            $id = (int) $_GET['id'];
            $estado = (int) $_GET['estado'];
            if ($userModel->cambiarEstado($id, $estado)) {
                $success = "Estado actualizado.";
            } else {
                $error = "Error al actualizar estado.";
            }
        }

        $usuarios = $userModel->obtenerTodos();
        include BASE_PATH . '/views/layouts/header.php';
        include BASE_PATH . '/views/admin/usuarios.php';
        break;

    default:
        include BASE_PATH . '/views/layouts/header.php';
        include BASE_PATH . '/views/admin/dashboard.php';
        break;
}

// Footer
include BASE_PATH . '/views/layouts/footer.php';
