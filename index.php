<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de Asistencia</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

    <!-- BARRA DE NAVEGACIÓN SUPERIOR (NAVBAR AZUL OSCURO) -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <span>⏱️</span>
                <h2>Asistencia</h2>
            </div>
            <nav class="navbar-menu">
                <a href="index.php" class="nav-item active">
                    <span>🏠</span> Inicio / Marcación
                </a>
                <a href="views/registrar.php" class="nav-item">
                    <span>👤</span> Registrar Nuevo Empleado
                </a>
                <a href="views/historial.php" class="nav-item">
                    <span>📋</span> Ver Historial por Persona
                </a>
                <a href="views/reportes.php" class="nav-item">
                    <span>📊</span> Generar Reporte por Persona
                </a>
            </nav>
        </div>
    </header>

    <!-- CONTENIDO PRINCIPAL CENTRADO -->
    <main class="main-container">
        
        <div class="card">
            <h2>Reloj Marcador de Asistencia</h2>
            <br>
            <h3>Registrar Marca Rápida</h3>
            <br>
            <form action="controllers/AsistenciaController.php" method="POST">
                <div class="form-group">
                    <label for="dni">Ingrese número de DNI:</label>
                    <input type="text" id="dni" name="dni" placeholder="Ej. 12345678" required autofocus maxlength="8">
                </div>

                <div class="form-group">
                    <label for="tipo_marca">Seleccione Acción:</label>
                    <select id="tipo_marca" name="tipo_marca" required>
                        <option value="ENTRADA">🟢 Entrada</option>
                        <option value="SALIDA">🔴 Salida</option>
                    </select>
                </div>

                <button type="submit" class="btn">Registrar Marca</button>
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