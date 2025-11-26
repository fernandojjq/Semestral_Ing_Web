<?php
namespace Src\Models;

use Config\Conexion;
use PDO;

class UserModel
{
    private $conn;

    public function __construct()
    {
        $database = new Conexion();
        $this->conn = $database->getConnection();
    }

    public function obtenerTodos()
    {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $email, $password, $rol)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, email, password, rol, activo) VALUES (?, ?, ?, ?, 1)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $email, $hash, $rol]);
    }

    public function cambiarEstado($id, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE usuarios SET activo = ? WHERE id = ?");
        return $stmt->execute([$estado, $id]);
    }

    public function existeEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function actualizar($id, $nombre, $email, $rol, $password = null)
    {
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ?, password = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$nombre, $email, $rol, $hash, $id]);
        } else {
            $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$nombre, $email, $rol, $id]);
        }
    }
}
