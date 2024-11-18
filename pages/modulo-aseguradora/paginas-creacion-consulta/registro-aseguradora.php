<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Aseguradora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/registro-aseguradora.css">
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Registro de Aseguradora</h2>
        <form action="../../../data-process/crud/modulo-aseguradora/procesar-registro-aseguradora.php" method="POST">
            <div class="mb-3">
                <label for="nombreAseguradora" class="form-label">Nombre de la Aseguradora</label>
                <input type="text" class="form-control" id="nombreAseguradora" name="nombreAseguradora" required>
            </div>

            <div class="mb-3">
                <label for="polizaSeguro" class="form-label">Póliza de Seguro 
                    <span class="text-muted small">(Formato: PS-0000)</span>
                </label>
                <input type="text" class="form-control" id="polizaSeguro" 
                       name="polizaSeguro"
                       pattern="PS-\d{4}" 
                       placeholder="Ej: PS-1234" 
                       required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fechaFinal" class="form-label">Fecha Final</label>
                    <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" required>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-submit w-100">Registrar Aseguradora</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>