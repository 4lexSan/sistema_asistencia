<?php
require_once '../models/ReporteAsistencia.php';

$reporte = new ReporteAsistencia();
$asistencias = $reporte->obtenerTodasLasAsistencias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Asistencias</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>

    <!-- BARRA SUPERIOR (NAVBAR) -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <span>⏱️</span>
                <h2>Asistencia</h2>
            </div>
            <nav class="navbar-menu">
                <a href="../index.php" class="nav-item">
                    <span>🏠</span> Inicio / Marcación
                </a>
                <a href="registrar.php" class="nav-item">
                    <span>👤</span> Registrar Nuevo Empleado
                </a>
                <a href="historial.php" class="nav-item active">
                    <span>📋</span> Ver Historial por Persona
                </a>
                <a href="reportes.php" class="nav-item">
                    <span>📊</span> Generar Reporte por Persona
                </a>
            </nav>
        </div>
    </header>

    <!-- CONTENIDO -->
    <main class="main-container">
        <div class="card card-wide">
            <h2>Historial de Asistencias</h2>
            <br>
            <?php if (count($asistencias) > 0): ?>
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
                            <?php foreach ($asistencias as $fila): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['dni']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['hora']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['tipo']); ?></td>
                                    <td>
                                        <?php 
                                            $estadoClass = 'badge';
                                            $estadoTexto = strtolower($fila['estado']);
                                            if (strpos($estadoTexto, 'tiempo') !== false || strpos($estadoTexto, 'puntual') !== false) {
                                                $estadoClass .= ' badge-a-tiempo';
                                            } elseif (strpos($estadoTexto, 'tardanza') !== false) {
                                                $estadoClass .= ' badge-tardanza';
                                            } else {
                                                $estadoClass .= ' badge-libre';
                                            }
                                        ?>
                                        <span class="<?php echo $estadoClass; ?>"><?php echo htmlspecialchars($fila['estado']); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No hay marcas de asistencia registradas.</div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>