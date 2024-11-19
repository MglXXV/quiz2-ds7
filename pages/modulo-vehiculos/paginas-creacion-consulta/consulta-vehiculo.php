<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/consultar-vehiculos.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Consulta de Vehículo</h1>
        
        <!-- Formulario de consulta -->
        <form method="POST" action="../../../data-process/crud/modulo-vehiculo/procesar-consulta-vehiculo.php" class="mb-4">
            <div class="form-group">
                <label for="numeroPlaca" class="form-label">Número de Placa</label>
                <input type="text" class="form-control" id="numeroPlaca" name="numeroPlaca" required placeholder="Ingrese número de placa">
            </div>
            <button type="submit" class="btn btn-primary">Consultar Vehículo</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
