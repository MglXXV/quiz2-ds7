<?php

require_once '../../../database/database.php';
require_once '../../../classes/Propietario.php';

// Verificar si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $nombrePropietario = htmlspecialchars($_POST['nombrePropietario']);
    $cedulaPropietario = htmlspecialchars($_POST['cedulaPropietario']);
    $contactoPropietario = htmlspecialchars($_POST['contactoPropietario']);
    $direccionPropietario = htmlspecialchars($_POST['direccionPropietario']);
    $idTipoPropietario = $_POST['idTipoPropietario'];  // Suponiendo que es el ID del tipo (Natural o Jurídico)

    // Validar formato de cédula y contacto (Ejemplo: 0-000-0000 y 0000-0000)
    if (!preg_match('/^\d{1,2}-\d{3}-\d{4}$/', $cedulaPropietario)) {
        mostrarMensaje('error', 'La cédula debe seguir el formato: 0-000-0000.');
        exit();
    }

    if (!preg_match('/^\d{4}-\d{4}$/', $contactoPropietario)) {
        mostrarMensaje('error', 'El contacto debe seguir el formato: 0000-0000.');
        exit();
    }

    // Crear un objeto de la clase propietario
    $propietarioObj = new Propietario($nombrePropietario, $cedulaPropietario, $contactoPropietario, $direccionPropietario, $idTipoPropietario);

    // Conectar a la base de datos
    $database = new database();
    $db = $database->getConnection();

    try {
        // Preparar la consulta SQL para insertar los datos
        $query = "INSERT INTO Propietario (nombrePropietario, cedulaPropietario, contactoPropietario, direccionPropietario, idTipoPropietario) 
                  VALUES (:nombrePropietario, :cedulaPropietario, :contactoPropietario, :direccionPropietario, :idTipoPropietario)";

        $stmt = $db->prepare($query);

        // Vincular los valores utilizando los métodos get de la clase propietario
        $stmt->bindParam(':nombrePropietario', $propietarioObj->getNombrePropietario());
        $stmt->bindParam(':cedulaPropietario', $propietarioObj->getCedulaPropietario());
        $stmt->bindParam(':contactoPropietario', $propietarioObj->getContactoPropietario());
        $stmt->bindParam(':direccionPropietario', $propietarioObj->getDireccionPropietario());
        $stmt->bindParam(':idTipoPropietario', $propietarioObj->getIdTipoPropietario());

        // Ejecutar la consulta
        if ($stmt->execute()) {
            mostrarMensaje('exito', 'El propietario se ha registrado correctamente.');
            header("Refresh:5; url=../../../pages/modulo-propietario/propietario-index.php");
            exit();
        } else {
            mostrarMensaje('error', 'Error en el registro del propietario');
            header("Refresh:5; url=../../../pages/modulo-propietario/paginas-creacion-consulta/registro-propietario.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error al procesar los datos: " . $e->getMessage();
    }
} else {
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
