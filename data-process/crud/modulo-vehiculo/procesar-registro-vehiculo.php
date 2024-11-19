<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Function to sanitize string input
function sanitizeInput($input) {
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    $sanitized = trim(strip_tags($input));
    return htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
}


// Include required files
require_once '../../../classes/Vehiculo.php';
require_once '../../../classes/EspecificacionesTecnicas.php';
require_once '../../../database/database.php';

// Initialize variables
$mensaje = "";
$claseMensaje = "";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        

        // Sanitize string inputs
        $numeroVin = sanitizeInput($_POST['numeroVin'] ?? '');
        $numeroPlaca = sanitizeInput($_POST['numeroPlaca'] ?? '');
        $modeloVehiculo = sanitizeInput($_POST['modeloVehiculo'] ?? '');
        $marcaVehiculo = sanitizeInput($_POST['marcaVehiculo'] ?? '');
        $colorVehiculo = sanitizeInput($_POST['colorVehiculo'] ?? '');
        $fechaFabricacion = sanitizeInput($_POST['fechaFabricacion'] ?? '');
        $fechaFabricacion = DateTime::createFromFormat('Y-m-d', $_POST['fecha_fabricacion']);
        if ($fechaFabricacion) {
             $fechaFabricacion = $fechaFabricacion->format('Y-m-d');  // Asegura el formato adecuado
        } else {
    // Maneja el error si la fecha es inválida
        }
        $cedulaPropietario = sanitizeInput($_POST['cedulaPropietario'] ?? '');
        
        // Sanitize numeric inputs
        $idAseguradora = filter_var($_POST['idAseguradora'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $capacidadMotor = filter_var($_POST['capacidadDelMotor'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $numeroCilindros = filter_var($_POST['numeroCilindros'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $pesoVehiculo = filter_var($_POST['pesoVehiculo'] ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $idTipoVehiculo = filter_var($_POST['idTipoVehiculo'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $idTipoTransmision = filter_var($_POST['idTipoTransmision'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $idTipoCombustible = filter_var($_POST['idTipoCombustible'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

        // Database connection
        $database = new Database();
        $db = $database->getConnection();

        // Start transaction
        $db->beginTransaction();

        // Get owner ID
        $stmt = $db->prepare("SELECT idPropietario FROM Propietario WHERE cedulaPropietario = :cedulaPropietario");
        $stmt->bindParam(':cedulaPropietario', $cedulaPropietario);
        $stmt->execute();
        $propietario = $stmt->fetch(PDO::FETCH_ASSOC);

        $idPropietario = $propietario['idPropietario'];

        // Create and register vehicle
        $vehiculo = new Vehiculo(
            $numeroVin,
            $numeroPlaca,
            $modeloVehiculo,
            $marcaVehiculo,
            $colorVehiculo,
            $fechaFabricacion,
            $idPropietario,
            $idAseguradora
        );

        if (!$vehiculo->registrarVehiculo($db)) {
            throw new Exception("Error al registrar el vehículo");
        }

        $idVehiculo = $db->lastInsertId();

        // Create and register technical specifications
        $especificaciones = new EspecificacionesTecnicas(
            $capacidadMotor,
            $numeroCilindros,
            $pesoVehiculo,
            $idVehiculo,
            $idTipoVehiculo,
            $idTipoTransmision,
            $idTipoCombustible
        );

        if (!$especificaciones->registrarEspecificaciones($db)) {
            throw new Exception("Error al registrar las especificaciones técnicas");
        }

        // Commit transaction
        $db->commit();

        // Success message
        $mensaje = "¡Registro completado exitosamente!";
        $claseMensaje = "alert alert-success";
        
    } catch (PDOException $e) {
        if (isset($db)) {
            $db->rollBack();
        }
        // Error message for database issues
        $mensaje = "Error en la base de datos: " . $e->getMessage();
        $claseMensaje = "alert alert-danger";
    } catch (Exception $e) {
        if (isset($db)) {
            $db->rollBack();
        }
        // Error message for other issues
        $mensaje = $e->getMessage();
        $claseMensaje = "alert alert-danger";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 50px; }
        .alert { font-size: 18px; margin-bottom: 20px; }
        .btn { margin-right: 10px; }
        pre { white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($mensaje): ?>
            <!-- Mostrar mensaje de éxito o error -->
            <div class="<?= htmlspecialchars($claseMensaje); ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($mensaje); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="btn-group">
            <a href="../../../pages/modulo-vehiculos/paginas-creacion-consulta/registro-vehiculo.php" class="btn btn-primary">Volver al Registro</a>
            <a href="../../../index.php" class="btn btn-secondary">Menú Principal</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
