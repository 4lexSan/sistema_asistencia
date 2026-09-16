<?php
require_once 'Empleado.php';

class EmpleadoPorHoras extends Empleado {
    public function registrarAsistencia(string $fecha, string $hora): array {
        $marcas = $this->getMarcas();
        $ultimaMarca = end($marcas);
        $tipo = ($ultimaMarca && $ultimaMarca['tipo'] === 'ENTRADA') ? 'SALIDA' : 'ENTRADA';

        return [
            'dni' => $this->getDni(),
            'fecha' => $fecha,
            'hora' => $hora,
            'tipo' => $tipo,
            'estado' => 'LIBRE'
        ];
    }
}