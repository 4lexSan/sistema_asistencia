<?php
require_once 'clases/RelojAsistencia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = trim($_POST['dni']);
    $reloj = new RelojAsistencia();
    $empleado = $reloj->buscarPorDni($dni);

    if (!$empleado) {
        $msg = "❌ ERROR: El DNI '{$dni}' no está registrado en la BD.";
    } else {
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        // Polimorfismo en ejecución
        $marcaData = $empleado->registrarAsistencia($fecha, $hora);
        $reloj->guardarMarca($marcaData);

        $msg = "✅ {$empleado->getNombre()} | Marcó: {$marcaData['tipo']} | Fecha: {$fecha} {$hora} | Estado: {$marcaData['estado']}";
    }

    header("Location: index.php?mensaje=" . urlencode($msg));
    exit;
}