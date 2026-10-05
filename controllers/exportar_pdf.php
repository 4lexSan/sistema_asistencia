<?php
require_once '../models/RelojAsistencia.php';
require_once '../vendor/autoload.php'; // Carga de Dompdf u FPDF

use Dompdf\Dompdf;

// 1. Capturar el parámetro de búsqueda si viene por la URL
$busqueda = $_GET['busqueda'] ?? null;

// 2. Consultar al modelo con el filtro de búsqueda
$reloj = new RelojAsistencia();
$asistencias = $reloj->obtenerReportePorPersona($busqueda);

// 3. Armar la estructura HTML del reporte PDF
$html = '<h2>Reporte de Asistencias</h2>';
if (!empty($busqueda)) {
    $html .= '<p><strong>Filtro aplicado:</strong> ' . htmlspecialchars($busqueda) . '</p>';
}

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
    <thead>
        <tr style="background-color: #343a40; color: white;">
            <th>DNI</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>';

if (count($asistencias) > 0) {
    foreach ($asistencias as $fila) {
        $html .= '<tr>
            <td>' . htmlspecialchars($fila['dni']) . '</td>
            <td>' . htmlspecialchars($fila['nombre']) . '</td>
            <td>' . htmlspecialchars($fila['fecha']) . '</td>
            <td>' . htmlspecialchars($fila['hora']) . '</td>
            <td>' . htmlspecialchars($fila['tipo']) . '</td>
            <td>' . htmlspecialchars($fila['estado']) . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="6" align="center">No se encontraron registros.</td></tr>';
}

$html .= '</tbody></table>';

// 4. Generar y descargar el PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Forzar la descarga en el navegador
$dompdf->stream("Reporte_Asistencias.pdf", array("Attachment" => false));
exit();