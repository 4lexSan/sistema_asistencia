<?php
require_once 'clases/RelojAsistencia.php';

$reloj = new RelojAsistencia();
$asistencias = $reloj->obtenerTodasLasAsistencias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Asistencias</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="card card-wide">
        <h2>Historial de Asistencias</h2>

        <?php if (empty($asistencias)): ?>
            <p style="text-align: center;">No hay registros de asistencia aún.</p>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asistencias as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['dni']); ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($row['hora']); ?></td>
                                <td><strong><?php echo htmlspecialchars($row['tipo']); ?></strong></td>
                                <td>
                                    <span class="badge <?php echo strtolower(str_replace(' ', '-', $row['estado'])); ?>">
                                        <?php echo htmlspecialchars($row['estado']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <a href="index.php" class="nav-link">Volver al Reloj Marcador</a>
    </div>
</body>
</html>