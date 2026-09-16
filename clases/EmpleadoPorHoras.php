<?php
require_once 'Empleado.php';

class EmpleadoPorHoras extends Empleado {
    public function registrarAsistencia(string $fecha, string $hora, string $tipoElegido): array {
        return [
            'dni'    => $this->getDni(),
            'fecha'  => $fecha,
            'hora'   => $hora,
            'tipo'   => $tipoElegido,
            'estado' => 'LIBRE'
        ];
    }
}