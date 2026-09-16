<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Empleado</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="card">
        <h2>Registrar Nuevo Empleado</h2>

    <form action="guardar_empleado.php" method="POST">
        <label>DNI:</label><br>
        <input type="text" name="dni" required maxlength="8"><br><br>

        <label>Nombre Completo:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Tipo de Empleado:</label><br>
        <select name="tipo">
            <option value="fijo">Turno Fijo (Control Tardanza)</option>
            <option value="horas">Por Horas (Libre)</option>
        </select><br><br>

        <button type="submit">Guardar Empleado</button>
    </form>

    <br><a href="index.php">Volver al Reloj Marcador</a>

    <?php if (isset($_GET['res'])): ?>
        <p><b><?php echo htmlspecialchars($_GET['res']); ?></b></p>
    <?php endif; ?>
</div>
</body>
</html>