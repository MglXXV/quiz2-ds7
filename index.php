<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión Vehicular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/pagina-inicio.css">
</head>
<body>
    <div class="container welcome-container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h1 class="mb-4">Sistema de Gestión Vehicular</h1>
                <img src="img/vetor-de-relatorio-de-revisao-de-lista-de-verificacao-de-manutencao-de-veiculo-automotivo_212005-510-2186169229.jpg" alt="Imagen de bienvenida" class="img-fluid welcome-image mb-5">
            </div>
        </div>
        
        <div class="row gy-4">
            <div class="col-md-4">
                <button onclick="window.location.href='pages/modulo-vehiculos/vehiculo-index.php'" class="btn module-btn vehiculo-btn">
                    Módulo de Vehículos
                </button>
            </div>
            
            <div class="col-md-4">
                <button onclick="window.location.href='pages/modulo-propietario/propietario-index.php'" class="btn module-btn propietario-btn">
                    Módulo de Propietarios
                </button>
            </div>
            
            <div class="col-md-4">
                <button onclick="window.location.href='pages/modulo-aseguradora/aseguradora-index.php'" class="btn module-btn aseguradora-btn">
                    Módulo de Aseguradoras
                </button>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="mb-0">© 2024 Michael Gay - 1LS133</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>