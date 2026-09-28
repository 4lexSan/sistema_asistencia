<?php
require_once '../models/RelojAsistencia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = trim($_POST['dni']);
    $tipoMarca = $_POST['tipo_marca'];

    $reloj = new RelojAsistencia();
    $empleado = $reloj->buscarPorDni($dni);

    if (!$empleado) {
        $msg = "❌ ERROR: El DNI '{$dni}' no está registrado en el sistema.";
    } else {
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $marcaData = $empleado->registrarAsistencia($fecha, $hora, $tipoMarca);
        $reloj->guardarMarca($marcaData);

        $msg = "✅ {$empleado->getNombre()} | Accion: {$marcaData['tipo']} | Hora: {$hora} | Estado: {$marcaData['estado']}";
    }

    header("Location: ../views/index.php?mensaje=" . urlencode($msg));
    exit;
}