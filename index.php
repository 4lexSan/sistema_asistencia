<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reloj Marcador de Asistencia</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="card">
    <h2>Reloj Marcador de Asistencia</h2>
    
    <form action="procesar_marca.php" method="POST">
        <div>
            <label>Ingrese DNI:</label><br>
            <input type="text" name="dni" required autofocus maxlength="8">
        </div>
        <br>
        <div>
            <label>Seleccione Acción:</label><br>
            <select name="tipo_marca" required>
                <option value="ENTRADA">Entrada</option>
                <option value="SALIDA">Salida</option>
            </select>
        </div>
        <br>
        <button type="submit">Registrar Marca</button>
    </form>

    <br>
    <a href="registrar.php" class="nav-link">Registrar Nuevo Empleado</a>
    <br>
    <a href="historial.php" class="nav-link">Ver Historial de Asistencias</a>

    <?php if (isset($_GET['mensaje'])): ?>
        <h3><?php echo htmlspecialchars($_GET['mensaje']); ?></h3>
    <?php endif; ?>
</div>
</body>
</html>