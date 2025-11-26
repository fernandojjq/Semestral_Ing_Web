<?php
namespace Src\Clases;

use Config\Conexion;
use PDO;

class Auth
{
    private $conn;
    private $table_name = "usuarios";

    public function __construct()
    {
        $database = new Conexion();
        $this->conn = $database->getConnection();
    }

    public function login($email, $password)
    {
        $query = "SELECT id, nombre, password, rol, activo FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $email = Sanitizar::limpiar($email);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['password'])) {
                if ($row['activo'] == 1) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['rol'] = $row['rol'];
                    return true;
                } else {
                    return "Usuario inactivo.";
                }
            } else {
                return "Contraseña incorrecta.";
            }
        }
        return "Email no encontrado.";
    }

    public static function checkRole($required_role)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== $required_role) {
            return false;
        }
        return true;
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: /index.php");
        exit;
    }
}
