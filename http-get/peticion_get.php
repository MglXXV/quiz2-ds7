<?php
// Incluir la clase de conexión a la base de datos
require_once 'database/database.php';

// Crear instancia de la clase de base de datos
$database = new database();
$pdo = $database->getConnection();

// Establecer la cabecera Content-Type a JSON
header('Content-Type: application/json');

// Obtener todos los vehículos de la base de datos
function obtenerVehiculos() {
    global $pdo;

    // Consultar todos los vehículos
    $stmt = $pdo->prepare("SELECT * FROM Vehiculo");
    $stmt->execute();

    // Obtener los resultados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Verificar si la petición es GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener los vehículos
    $vehiculos = obtenerVehiculos();

    // Si hay vehículos, devolverlos como JSON
    if ($vehiculos) {
        echo json_encode($vehiculos);
    } else {
        // Si no se encuentran vehículos, devolver un mensaje de error
        echo json_encode(["mensaje" => "No se encontraron vehículos"]);
    }
} else {
    // Si no es una petición GET, devolver un mensaje de error
    echo json_encode(["mensaje" => "Método HTTP no permitido. Use GET."]);
}
?>
