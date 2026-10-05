<?php
require_once '../models/RelojAsistencia.php';

$busqueda = $_GET['busqueda'] ?? '';
$reloj = new RelojAsistencia();

// Consultar datos filtrados si hay término de búsqueda
$asistencias = !empty($busqueda) ? $reloj->obtenerReportePorPersona($busqueda) : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte por Persona - Reloj Marcador</title>
    <!-- Mismo llamado al CSS que usas en tu index.php -->
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>

    <div class="card card-wide">
        <h2>Generar Reporte por Persona</h2>

        <!-- Formulario de Búsqueda -->
        <form method="GET" action="reportes.php">
            <div class="form-group">
                <label for="busqueda">Empleado (Nombre o DNI):</label>
                <input type="text" 
                       id="busqueda" 
                       name="busqueda" 
                       placeholder="Ingrese Nombre o DNI..." 
                       value="<?php echo htmlspecialchars($busqueda); ?>" 
                       autofocus 
                       required>
            </div>
            <button type="submit" class="btn">Buscar y Generar Reporte</button>
        </form>

        <?php if (!empty($busqueda)): ?>
            <br>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                <h3>Resultados para: "<em><?php echo htmlspecialchars($busqueda); ?></em>"</h3>
                
                <!-- Botones de Exportación -->
                <div style="display: flex; gap: 10px;">
                    <a href="../controllers/exportar_excel.php?busqueda=<?php echo urlencode($busqueda); ?>" 
                       class="btn" 
                       style="background-color: #27ae60; text-decoration: none; text-align: center; padding: 8px 12px; border-radius: 5px; font-size: 0.9rem;">
                       📊 Excel
                    </a>
                    <button onclick="window.print()" class="btn" style="background-color: #e74c3c;">
                        📄 Imprimir / Guardar en PDF
                    </button>
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
                                            // Asignación de badges según la clase de tu CSS
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
                                        <span class="<?php echo $estadoClass; ?>">
                                            <?php echo htmlspecialchars($fila['estado']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    No se encontraron registros de asistencia para el trabajador ingresado.
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-info" style="margin-top: 20px;">
                Escriba el DNI o Nombre de la persona y presione <strong>ENTER</strong> o el botón para cargar el reporte.
            </div>
        <?php endif; ?>

        <br>
        <a href="../index.php">Volver al Inicio</a>
    </div>

</body>
</html>