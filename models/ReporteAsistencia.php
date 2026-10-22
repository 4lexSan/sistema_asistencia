<?php
require_once '../config/conexion.php';

class ReporteAsistencia {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
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

    public function obtenerReportePorPersona(?string $busqueda = null): array {
        $sql = "SELECT a.id, e.dni, e.nombre, a.fecha, a.hora, a.tipo, a.estado 
                FROM asistencias a 
                INNER JOIN empleados e ON a.empleado_dni = e.dni";
        
        $params = [];
        if (!empty($busqueda)) {
            // Busca si coincide el DNI exacto o si el Nombre contiene el texto ingresado
            $sql .= " WHERE e.dni LIKE :busqueda OR e.nombre LIKE :busqueda";
            $params[':busqueda'] = '%' . $busqueda . '%';
        }
        
        $sql .= " ORDER BY a.fecha DESC, a.hora DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}