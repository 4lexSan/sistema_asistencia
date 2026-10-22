<?php
require_once '../models/ReporteAsistencia.php';

$busqueda = $_GET['busqueda'] ?? '';
$reloj = new ReporteAsistencia();

// Consultar datos filtrados si hay término de búsqueda
$asistencias = !empty($busqueda) ? $reloj->obtenerReportePorPersona($busqueda) : [];
?>

<!DOCTYPE html>
<html lang="es">
<?php
require_once '../models/ReporteAsistencia.php';

$busqueda = $_GET['busqueda'] ?? '';
$reporte = new ReporteAsistencia();
$asistencias = !empty($busqueda) ? $reporte->obtenerReportePorPersona($busqueda) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reporte por Persona</title>
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
                <a href="historial.php" class="nav-item">
                    <span>📋</span> Ver Historial por Persona
                </a>
                <a href="reportes.php" class="nav-item active">
                    <span>📊</span> Generar Reporte por Persona
                </a>
            </nav>
        </div>
    </header>

    <!-- CONTENIDO -->
    <main class="main-container">
        <div class="card card-wide">
            <h2>Generar Reporte por Persona</h2>
            <br>
            <form method="GET" action="reportes.php">
                <div class="form-group">
                    <label for="busqueda">Empleado (Nombre o DNI):</label>
                    <input type="text" id="busqueda" name="busqueda" placeholder="Ingrese Nombre o DNI..." value="<?php echo htmlspecialchars($busqueda); ?>" autofocus required>
                </div>
                <button type="submit" class="btn">Buscar y Generar Reporte</button>
            </form>

            <?php if (!empty($busqueda)): ?>
                <br>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                    <h3>Resultados para: "<em><?php echo htmlspecialchars($busqueda); ?></em>"</h3>
                    <div style="display: flex; gap: 10px;">
                        <a href="../controllers/ExportarExcelController.php?busqueda=<?php echo urlencode($busqueda); ?>" class="btn" style="background-color: #10b981; padding: 8px 12px; font-size: 0.9rem;">📊 Excel</a>
                        <button onclick="window.print()" class="btn" style="background-color: #ef4444; padding: 8px 12px; font-size: 0.9rem;">📄 PDF / Imprimir</button>
                    </div>
                </div>

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
                    <div class="alert alert-info">No se encontraron registros de asistencia.</div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">Escriba el DNI o Nombre de la persona y presione <strong>ENTER</strong> o el botón para cargar el reporte.</div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>