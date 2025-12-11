<?php
namespace Src\Models;

use Config\Conexion;
use PDO;
use Exception;
use Src\Interfaces\IManejoErrores;

class DiarioModel implements IManejoErrores
{
    private $conn;

    public function __construct()
    {
        $database = new Conexion();
        $this->conn = $database->getConnection();
    }

    public function logError($mensaje)
    {
        // Implementación simple de log
        error_log($mensaje);
    }

    public function mostrarError($mensaje)
    {
        return $mensaje;
    }

    public function crearAsiento($usuario_id, $descripcion, $detalles, $fechaOperacion = null)
    {
        // $detalles es un array de arrays: [['cuenta_id' => 1, 'debe' => 100, 'haber' => 0], ...]

        try {
            $this->conn->beginTransaction();

            // 1. Validar Partida Doble
            $totalDebe = 0;
            $totalHaber = 0;

            foreach ($detalles as $detalle) {
                $totalDebe += $detalle['debe'];
                $totalHaber += $detalle['haber'];
            }

            // Usamos round para evitar problemas de precisión flotante
            if (round($totalDebe, 2) != round($totalHaber, 2)) {
                throw new Exception("Error de Partida Doble: La suma del DEBE ($totalDebe) no es igual a la suma del HABER ($totalHaber).");
            }

            // 2. Insertar Cabecera
            // Si no se pasa fechaOperacion, usamos la actual (date('Y-m-d H:i:s'))
            $fechaFinal = $fechaOperacion ? $fechaOperacion . ' ' . date('H:i:s') : date('Y-m-d H:i:s');

            // Insertamos 'fecha' (operativa) manual. 'created_at' (auditoría) es automático.
            $queryCabecera = "INSERT INTO diario_cabecera (usuario_id, descripcion, estado, fecha) VALUES (:usuario_id, :descripcion, 'abierto', :fecha)";
            $stmt = $this->conn->prepare($queryCabecera);
            $stmt->bindParam(":usuario_id", $usuario_id);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":fecha", $fechaFinal);
            $stmt->execute();

            $diarioId = $this->conn->lastInsertId();

            // 3. Insertar Detalles
            $queryDetalle = "INSERT INTO diario_detalles (diario_id, cuenta_id, debe, haber) VALUES (:diario_id, :cuenta_id, :debe, :haber)";
            $stmtDetalle = $this->conn->prepare($queryDetalle);

            foreach ($detalles as $detalle) {
                $stmtDetalle->bindParam(":diario_id", $diarioId);
                $stmtDetalle->bindParam(":cuenta_id", $detalle['cuenta_id']);
                $stmtDetalle->bindParam(":debe", $detalle['debe']);
                $stmtDetalle->bindParam(":haber", $detalle['haber']);
                $stmtDetalle->execute();
            }

            $this->conn->commit();
            return $diarioId;

        } catch (Exception $e) {
            $this->conn->rollBack();
            $this->logError($e->getMessage());
            throw $e; // Re-lanzar para que el controlador lo maneje
        }
    }

    public function obtenerAsientos($filtroMes = null)
    {
        $query = "SELECT d.*, u.nombre as usuario FROM diario_cabecera d JOIN usuarios u ON d.usuario_id = u.id";
        if ($filtroMes) {
            $query .= " WHERE MONTH(d.fecha) = :mes";
        }
        $query .= " ORDER BY d.fecha DESC, d.created_at DESC";

        $stmt = $this->conn->prepare($query);
        if ($filtroMes) {
            $stmt->bindParam(":mes", $filtroMes);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDetalles($diarioId)
    {
        $query = "SELECT dd.*, c.nombre as cuenta, c.codigo FROM diario_detalles dd JOIN catalogo_cuentas c ON dd.cuenta_id = c.id WHERE dd.diario_id = :diario_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":diario_id", $diarioId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cierreGerencial($mes, $usuario_id)
    {
        // Solo Gerente puede ejecutar esto (validado en controlador/vista, pero doble check aquí no está de más si pasamos el rol)
        // Generar Firma Digital (Simulada)
        $firma = hash('sha256', 'CIERRE_MES_' . $mes . '_USER_' . $usuario_id . '_' . time());

        $query = "UPDATE diario_cabecera SET estado = 'cerrado', firma_digital = :firma WHERE MONTH(fecha) = :mes AND estado = 'abierto'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":firma", $firma);
        $stmt->bindParam(":mes", $mes);

        if ($stmt->execute()) {
            return $stmt->rowCount(); // Retorna cuántos asientos se cerraron
        }
        return false;
    }
}
