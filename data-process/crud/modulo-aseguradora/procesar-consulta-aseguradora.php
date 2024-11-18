<?php
require_once '../../../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAseguradora'])) {
    // Obtener el nombre de la aseguradora y eliminar espacios innecesarios
    $idAseguradora = trim($_POST['idAseguradora']);
    
    // Validar si el nombre de la aseguradora está vacío
    if (empty($idAseguradora)) {
        echo '<div class="container mt-4">';
        echo '<div class="alert alert-warning" role="alert">Por favor, selecciona una aseguradora válida.</div>';
        echo '<a href="javascript:history.back()" class="btn btn-primary">Volver</a>';
        echo '</div>';
        exit;
    }

    try {
        // Conectar a la base de datos
        $db = new database();
        $conn = $db->getConnection();

        // Consulta para obtener los detalles de la aseguradora
        $query = "SELECT nombreAseguradora, polizaSeguro, fechaInicio, fechaVencimiento
                  FROM Aseguradora 
                  WHERE idAseguradora = :idAseguradora";
        
        // Preparar la consulta
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':idAseguradora', $idAseguradora);
        $stmt->execute();
        
        // Obtener los resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<div class="container mt-4">';
        
        // Verificar si se encontraron resultados
        if (!empty($results)) {
            echo '<h2 class="text-center mb-4">Detalles de la Aseguradora</h2>';
            echo '<table class="table table-striped table-bordered">';
            echo '<thead class="thead-dark">
                    <tr>
                        <th>Nombre de la Aseguradora</th>
                        <th>Póliza de Seguro</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Vencimiento</th>
                    </tr>
                  </thead>';
            echo '<tbody>';

            // Mostrar los resultados en la tabla
            foreach ($results as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['nombreAseguradora']) . '</td>';
                echo '<td>' . htmlspecialchars($row['polizaSeguro']) . '</td>';
                echo '<td>' . htmlspecialchars(date('d/m/Y', strtotime($row['fechaInicio']))) . '</td>';
                echo '<td>' . htmlspecialchars(date('d/m/Y', strtotime($row['fechaVencimiento']))) . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody></table>';
        } else {
            // Si no se encontraron resultados
            echo '<div class="alert alert-info" role="alert">No se encontraron resultados para la aseguradora seleccionada.</div>';
        }
        
        // Botón para volver atrás
        echo '<a href="javascript:history.back()" class="btn btn-secondary">Volver</a>';
        echo '</div>';

    } catch (PDOException $e) {
        // En caso de error en la consulta
        echo '<div class="container mt-4">';
        echo '<div class="alert alert-danger" role="alert">Error al realizar la consulta: ' . htmlspecialchars($e->getMessage()) . '</div>';
        echo '<a href="javascript:history.back()" class="btn btn-primary">Volver</a>';
        echo '</div>';
    }
} else {
    // Si no se ha enviado el formulario
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-warning" role="alert">Por favor, selecciona una aseguradora para realizar la consulta.</div>';
    echo '<a href="javascript:history.back()" class="btn btn-primary">Volver</a>';
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Aseguradora</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        /* Estilos personalizados para mejorar el diseño */
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 30px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #343a40;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .alert {
            font-size: 1.1rem;
        }

        .btn {
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <!-- Aquí es donde se generarán los mensajes dinámicos del PHP -->
</body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
