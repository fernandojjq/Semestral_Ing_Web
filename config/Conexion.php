<?php
namespace Config;

use PDO;
use PDOException;

class Conexion {
    private $host = 'localhost';
    private $db_name = 'sistema_financiero';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Requisito: Mensaje específico si falla WAMP/MySQL
            die("Error WAMP: Verifica que MySQL esté corriendo. Detalles: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
