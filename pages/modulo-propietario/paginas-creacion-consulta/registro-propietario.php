<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Propietario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/registro-propietario.css">
</head>

<body>
    <div class="container container-form">
        <h2 class="text-center mb-5">Registro de Propietario</h2>
        
        <form action="../../../data-process/crud/modulo-propietario/procesar-registro-propietario.php" method="POST">
            <div class="mb-3">
                <label for="nombrePropietario" class="form-label">Nombre del Propietario</label>
                <input type="text" class="form-control" id="nombrePropietario" name="nombrePropietario" required>
            </div>

            <div class="mb-3">
                <label for="cedulaPropietario" class="form-label">Cédula del Propietario</label>
                <input type="text" class="form-control" id="cedulaPropietario" name="cedulaPropietario" placeholder="Ejemplo: 0-000-0000" pattern="\d{1}-\d{3}-\d{4}" required>
                <small class="form-text text-muted">Formato: 0-000-0000</small>
            </div>

            <div class="mb-3">
                <label for="contactoPropietario" class="form-label">Contacto del Propietario</label>
                <input type="text" class="form-control" id="contactoPropietario" name="contactoPropietario" placeholder="Ejemplo: 0000-0000" pattern="\d{4}-\d{4}" required>
                <small class="form-text text-muted">Formato: 0000-0000</small>
            </div>

            <div class="mb-3">
                <label for="direccionPropietario" class="form-label">Dirección del Propietario</label>
                <input type="text" class="form-control" id="direccionPropietario" name="direccionPropietario" required>
            </div>

            <div class="mb-3">
                <label for="idTipoPropietario" class="form-label">Tipo de Propietario</label>
                <select class="form-select" name="idTipoPropietario" id="idTipoPropietario" required>
                    <?php
                    require_once '../../../database/database.php';
                    $db = new database();
                    $conn = $db->getConnection();

                    try {
                        // Consulta para obtener los tipos de propietario (natural, juridico)
                        $query = "SELECT idTipoPropietario, tipoPropietario FROM TipoPropietario";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();

                        // Generar opciones del combobox
                        $tiposPropietario = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($tiposPropietario)) {
                            foreach ($tiposPropietario as $tipo) {
                                echo "<option value='" . htmlspecialchars($tipo['idTipoPropietario']) . "'>" . 
                                     htmlspecialchars($tipo['tipoPropietario']) . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No hay tipos de propietario disponibles</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value='' disabled>Error al cargar tipos de propietario: " . htmlspecialchars($e->getMessage()) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100">Registrar Propietario</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
