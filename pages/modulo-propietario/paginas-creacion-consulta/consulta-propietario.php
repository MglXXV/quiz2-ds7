<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Propietario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/consulta-propietario.css">
</head>
<body>
    <div class="container">
        <h2>Consulta de Propietario</h2>
        <form action="../../../data-process/crud/modulo-propietario/procesar-consulta-propietario.php" method="POST">
            <div class="mb-3">
                <label for="cedulaPropietario" class="form-label">Cédula del Propietario</label>
                <input type="text" class="form-control" id="cedulaPropietario" name="cedulaPropietario" placeholder="Ejemplo: 0-000-0000" required>
            </div>
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
