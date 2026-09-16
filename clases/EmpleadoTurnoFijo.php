<?php
require_once 'Empleado.php';

class EmpleadoTurnoFijo extends Empleado {
    private string $horaEntradaOficial = "08:00:00";

    public function registrarAsistencia(string $fecha, string $hora): array {
        $marcas = $this->getMarcas();
        $ultimaMarca = end($marcas);
        $tipo = ($ultimaMarca && $ultimaMarca['tipo'] === 'ENTRADA') ? 'SALIDA' : 'ENTRADA';

        $estado = "A TIEMPO";
        if ($tipo === 'ENTRADA' && $hora > $this->horaEntradaOficial) {
            $estado = "TARDANZA";
        }

        return [
            'dni' => $this->getDni(),
            'fecha' => $fecha,
            'hora' => $hora,
            'tipo' => $tipo,
            'estado' => $estado
        ];
    }
}