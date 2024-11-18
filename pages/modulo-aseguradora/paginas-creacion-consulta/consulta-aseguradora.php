<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Aseguradora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/consulta-aseguradora.css">
</head>

<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Consulta de Aseguradora</h2>
        <form action="../../../data-process/crud/modulo-aseguradora/procesar-consulta-aseguradora.php" method="POST">
            <div class="mb-3">
                <label for="nombreAseguradora" class="form-label">Selecciona una Aseguradora</label>
                <select class="form-select" name="idAseguradora" id="idAseguradora" required aria-label="Seleccionar Aseguradora">
                    <?php
                    // Conexión a la base de datos
                    require_once '../../../database/database.php';
                    try {
                        $db = new database();
                        $conn = $db->getConnection();

                        $query = "SELECT idAseguradora, nombreAseguradora FROM Aseguradora";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();

                        // Generar opciones del combobox
                        $aseguradoras = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (!empty($aseguradoras)) {
                            foreach ($aseguradoras as $aseguradora) {
                                // Escape de datos para prevenir XSS
                                $idAseguradora = htmlspecialchars($aseguradora['idAseguradora']);
                                $nombreAseguradora = htmlspecialchars($aseguradora['nombreAseguradora']);
                                echo "<option value='$idAseguradora'>$nombreAseguradora</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No se encontraron aseguradoras.</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value='' disabled>Error al cargar aseguradoras: " . htmlspecialchars($e->getMessage()) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-submit w-100">Consultar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
