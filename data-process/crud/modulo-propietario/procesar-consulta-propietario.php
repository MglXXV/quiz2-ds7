<?php
// Incluir conexión a la base de datos
require_once '../../../database/database.php';

// Inicializar variables
$resultado = null;
$error = null;

// Validar el método de la petición y procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validar que el campo no esté vacío
        if (empty($_POST['cedulaPropietario'])) {
            throw new Exception('La cédula es requerida');
        }

        // Validar formato de cédula (0-000-0000)
        $cedula = trim($_POST['cedulaPropietario']);
        if (!preg_match('/^\d{1,2}-\d{3}-\d{4}$/', $cedula)) {
            throw new Exception('Formato de cédula inválido. Use el formato: 0-000-0000');
        }

        $cedulaPropietario = htmlspecialchars($cedula);

        // Conectar a la base de datos
        $database = new database();
        $db = $database->getConnection();

        // Consultar en la base de datos según la cédula
        $query = "SELECT p.nombrePropietario, p.cedulaPropietario, p.contactoPropietario, 
                         p.direccionPropietario, t.tipoPropietario 
                  FROM Propietario p INNER JOIN TipoPropietario t    ON t.idTipoPropietario = p.idTipoPropietario
                  WHERE p.cedulaPropietario = :cedulaPropietario
                  LIMIT 1";
                  
        $stmt = $db->prepare($query);
        $stmt->bindParam(':cedulaPropietario', $cedulaPropietario);
        $stmt->execute();

        // Obtener resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de consulta de propietarios">
    <title>Consulta de Propietario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }

        .btn {
            display: inline-block;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .table {
            margin-top: 30px;
            width: 100%;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .alert {
            margin-top: 20px;
        }

        /* Agregamos diseño responsivo */
        @media (max-width: 768px) {
            .table {
                display: block;
                overflow-x: auto;
            }
            
            .container {
                margin: 20px auto;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Consulta de Propietario</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="cedulaPropietario" class="form-label">Cédula del Propietario</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="cedulaPropietario" 
                    name="cedulaPropietario" 
                    pattern="\d{1,2}-\d{3}-\d{4}"
                    placeholder="Ejemplo: 0-000-0000" 
                    value="<?php echo isset($_POST['cedulaPropietario']) ? htmlspecialchars($_POST['cedulaPropietario']) : ''; ?>"
                    required
                >
                <div class="invalid-feedback">
                    Por favor ingrese una cédula válida en el formato 0-000-0000
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>

        <!-- Tabla de Resultados -->
        <?php if (isset($resultado)): ?>
            <h3 class="mt-5">Resultados de la Consulta</h3>
            <?php if ($resultado): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre Propietario</th>
                            <th>Cédula</th>
                            <th>Contacto</th>
                            <th>Dirección</th>
                            <th>Tipo de Propietario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($resultado['nombrePropietario']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['cedulaPropietario']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['contactoPropietario']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['direccionPropietario']); ?></td>
                            <td><?php echo htmlspecialchars($resultado['tipoPropietario']); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    No se encontraron resultados para la cédula proporcionada.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Validación del formulario del lado del cliente
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>
</html>