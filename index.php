<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Asistencia</title>
</head>
<body>
    <h2>Reloj Marcador de Asistencia</h2>
    
    <form action="procesar_marca.php" method="POST">
        <label>Ingrese DNI:</label>
        <input type="text" name="dni" required autofocus maxlength="8">
        <button type="submit">Marcar</button>
    </form>

    <br><a href="registrar.php">Registrar Nuevo Empleado</a>

    <?php if (isset($_GET['mensaje'])): ?>
        <h3><?php echo htmlspecialchars($_GET['mensaje']); ?></h3>
    <?php endif; ?>
</body>
</html>