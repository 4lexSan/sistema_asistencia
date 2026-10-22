<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Empleado</title>
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
                <a href="registrar.php" class="nav-item active">
                    <span>👤</span> Registrar Nuevo Empleado
                </a>
                <a href="historial.php" class="nav-item">
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
        <div class="card">
            <h2>Registrar Nuevo Empleado</h2>
            <br>
            <form action="../controllers/EmpleadoController.php" method="POST">
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" required maxlength="8" placeholder="Ej. 12345678">
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ej. Juan Pérez">
                </div>

                <div class="form-group">
                    <label for="tipo_empleado">Tipo de Empleado:</label>
                    <select id="tipo_empleado" name="tipo_empleado" required>
                        <option value="fijo">Turno Fijo (Control Tardanza)</option>
                        <option value="horas">Por Horas (Horario Libre)</option>
                    </select>
                </div>

                <button type="submit" class="btn">Guardar Empleado</button>
            </form>

            <?php if (isset($_GET['mensaje'])): ?>
                <div class="alert alert-info" style="margin-top: 15px;">
                    <?php echo htmlspecialchars($_GET['mensaje']); ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>