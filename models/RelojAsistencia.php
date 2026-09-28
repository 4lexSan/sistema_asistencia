<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once '../models/EmpleadoTurnoFijo.php';
require_once '../models/EmpleadoPorHoras.php';

class RelojAsistencia {
    private PDO $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function buscarPorDni(string $dni): ?Empleado {
        // Consultar Empleado
        $stmt = $this->db->prepare("SELECT * FROM empleados WHERE dni = :dni");
        $stmt->execute([':dni' => $dni]);
        $empData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$empData) return null;

        // Consultar Historial de Asistencias del Empleado
        $stmtMarcas = $this->db->prepare("SELECT fecha, hora, tipo, estado FROM asistencias WHERE empleado_dni = :dni ORDER BY id ASC");
        $stmtMarcas->execute([':dni' => $dni]);
        $marcas = $stmtMarcas->fetchAll(PDO::FETCH_ASSOC);

        // Instanciar según el tipo (Polimorfismo)
        if ($empData['tipo_empleado'] === 'fijo') {
            return new EmpleadoTurnoFijo($empData['dni'], $empData['nombre'], $marcas);
        } else {
            return new EmpleadoPorHoras($empData['dni'], $empData['nombre'], $marcas);
        }
    }

    public function guardarEmpleado(string $dni, string $nombre, string $tipo): bool {
        try {
            $stmt = $this->db->prepare("INSERT INTO empleados (dni, nombre, tipo_empleado) VALUES (:dni, :nombre, :tipo)");
            return $stmt->execute([':dni' => $dni, ':nombre' => $nombre, ':tipo' => $tipo]);
        } catch (PDOException $e) {
            return false; // Retorna false si el DNI está duplicado
        }
    }

    public function guardarMarca(array $marca): bool {
        $stmt = $this->db->prepare("INSERT INTO asistencias (empleado_dni, fecha, hora, tipo, estado) VALUES (:dni, :fecha, :hora, :tipo, :estado)");
        return $stmt->execute([
            ':dni' => $marca['dni'],
            ':fecha' => $marca['fecha'],
            ':hora' => $marca['hora'],
            ':tipo' => $marca['tipo'],
            ':estado' => $marca['estado']
        ]);
    }

    public function obtenerTodasLasAsistencias(): array {
    $sql = "SELECT a.id, a.empleado_dni AS dni, e.nombre, a.fecha, a.hora, a.tipo, a.estado 
            FROM asistencias a 
            INNER JOIN empleados e ON a.empleado_dni = e.dni 
            ORDER BY a.fecha DESC, a.hora DESC";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}