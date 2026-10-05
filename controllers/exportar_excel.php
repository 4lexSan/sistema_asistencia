<?php
require_once '../models/RelojAsistencia.php';

// 1. Capturar el parámetro de búsqueda
$busqueda = $_GET['busqueda'] ?? null;

// 2. Obtener los datos del modelo
$reloj = new RelojAsistencia();
$asistencias = $reloj->obtenerReportePorPersona($busqueda);

// 3. Configurar cabeceras HTTP para forzar la descarga en formato Excel
$filename = "Reporte_Asistencia_" . date('Y-m-d') . ".xls";

header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// Añadir BOM para que los caracteres con tildes o 'ñ' se muestren correctamente en Excel
echo "\xEF\xBB\xBF";
?>

<!-- Tabla HTML que Excel interpretará como hoja de cálculo -->
<table border="1">
    <thead>
        <tr style="background-color: #2c3e50; color: #ffffff;">
            <th>DNI</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($asistencias)): ?>
            <?php foreach ($asistencias as $fila): ?>
                <tr>
                    <td>'<?php echo htmlspecialchars($fila['dni']); ?></td>
                    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($fila['hora']); ?></td>
                    <td><?php echo htmlspecialchars($fila['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No se encontraron registros de asistencia.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>