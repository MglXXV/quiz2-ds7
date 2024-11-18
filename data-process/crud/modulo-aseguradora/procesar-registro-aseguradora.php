<?php

require_once '../../../database/database.php';
require_once '../../../classes/Aseguradora.php';

// Verificar si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $nombreAseguradora = htmlspecialchars($_POST['nombreAseguradora']);
    $polizaSeguro = htmlspecialchars($_POST['polizaSeguro']);
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFinal = $_POST['fechaFinal'];

    // Validar que las fechas sean coherentes
    if ($fechaInicio > $fechaFinal) {
        mostrarMensaje("error","La fecha de inicio no puede ser mayor que la fecha final.");
    }

    // Crear un objeto de la clase aseguradora
    $aseguradoraObj = new aseguradora($nombreAseguradora, $polizaSeguro, $fechaInicio, $fechaFinal);

    // Conectar a la base de datos
    $database = new database();
    $db = $database->getConnection();

    try {
        // Preparar la consulta SQL para insertar los datos
        $query = "INSERT INTO Aseguradora (nombreAseguradora, polizaSeguro, fechaInicio, fechaVencimiento) 
                  VALUES (:nombreAseguradora, :polizaSeguro, :fechaInicio, :fechaFinal)";

        $stmt = $db->prepare($query);

        // Vincular los valores utilizando los métodos get de la clase aseguradora
        $stmt->bindParam(':nombreAseguradora', $aseguradoraObj->getNombreAseguradora());
        $stmt->bindParam(':polizaSeguro', $aseguradoraObj->getPolizaSeguro());
        $stmt->bindParam(':fechaInicio', $aseguradoraObj->getFechaInicio());
        $stmt->bindParam(':fechaFinal', $aseguradoraObj->getFechaFinal());

        // Ejecutar la consulta
        if ($stmt->execute()) {
            mostrarMensaje('exito', 'La aseguradora se ha registrado correctamente.');
            header("Refresh:5; url=../../../pages/modulo-aseguradora/aseguradora-index.php");
            exit();
        } else {
            mostrarMensaje('error', 'Error en el registro de la consulta');
            mostrarMensaje('exito', 'La aseguradora se ha registrado correctamente.');
            header("Refresh:5; url=../../../pages/modulo-aseguradora/paginas-creacion-consulta/registro-aseguradora.php");
            exit();

        }
    } 
    
    catch (PDOException $e) {
        echo "Error al procesar los datos: " . $e->getMessage();
    }
}   else {
        echo "Método de solicitud no permitido.";
}

// Función para mostrar mensajes estilizados
function mostrarMensaje($tipo, $mensaje) {
    $estiloExito = "
        background-color: #e6ffe6;
        color: #2d862d;
        border: 2px solid #2d862d;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        font-family: Arial, sans-serif;
        margin: 20px auto;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    ";

    $estiloError = "
        background-color: #ffe6e6;
        color: #d11a2a;
        border: 2px solid #d11a2a;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        font-family: Arial, sans-serif;
        margin: 20px auto;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    ";

    if ($tipo === 'exito') {
        echo "<div style='{$estiloExito}'>
                <h2 style='margin: 0;'>✔️ ¡Registro exitoso!</h2>
                <p>{$mensaje}</p>
              </div>";
    } else {
        echo "<div style='{$estiloError}'>
                <h2 style='margin: 0;'>❌ ¡Registro fallido!</h2>
                <p>{$mensaje}</p>
              </div>";
    }
}

?>