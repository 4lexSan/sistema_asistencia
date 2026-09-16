<?php
require_once 'Empleado.php';

class EmpleadoTurnoFijo extends Empleado {
    private string $horaEntradaOficial = "08:00:00";

    public function registrarAsistencia(string $fecha, string $hora, string $tipoElegido): array {
        $estado = "OK";

        if ($tipoElegido === 'ENTRADA') {
            $estado = ($hora > $this->horaEntradaOficial) ? "TARDANZA" : "A TIEMPO";
        }

        return [
            'dni'    => $this->getDni(),
            'fecha'  => $fecha,
            'hora'   => $hora,
            'tipo'   => $tipoElegido,
            'estado' => $estado
        ];
    }
}