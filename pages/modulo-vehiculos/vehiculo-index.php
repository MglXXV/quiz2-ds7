<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Módulo de Vehículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/vehiculo-index.css"> <!-- Asegúrate de crear este archivo CSS -->
</head>

<body>
    <div class="container container-modulo text-center">
        <h1 class="mb-5">Módulo de Vehículos</h1>

        <div class="row gy-4">
            <!-- Botón para registrar un vehículo -->
            <div class="col-12 mb-3">
                <button onclick="window.location.href='paginas-creacion-consulta/registro-vehiculo.php'" class="btn modulo-btn registro-btn">
                    Registrar Vehículo
                </button>
            </div>

            <!-- Botón para consultar un vehículo -->
            <div class="col-12 mb-3">
                <button onclick="window.location.href='paginas-creacion-consulta/consulta-vehiculo.php'" class="btn modulo-btn consulta-btn">
                    Consultar Vehículo
                </button>
            </div>

            <!-- Botón para regresar al menú principal -->
            <div class="col-12">
                <button onclick="window.location.href='../../index.php'" class="btn volver-btn">
                    Volver al Menú Principal
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
