<?php
require_once 'clases/RelojAsistencia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = trim($_POST['dni']);
    $nombre = trim($_POST['nombre']);
    $tipo = $_POST['tipo'];

    $reloj = new RelojAsistencia();
    $exito = $reloj->guardarEmpleado($dni, $nombre, $tipo);

    if ($exito) {
        $res = "✅ Empleado guardado en la BD correctamente.";
    } else {
        $res = "❌ El DNI {$dni} ya se encuentra registrado.";
    }

    header("Location: registrar.php?res=" . urlencode($res));
    exit;
}