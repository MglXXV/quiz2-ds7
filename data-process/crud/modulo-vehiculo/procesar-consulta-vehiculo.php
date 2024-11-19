<?php

// Mostrar todos los errores
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Incluir la clase database para la conexión
require_once '../../../database/database.php';

// Crear una instancia de la clase database
$database = new database();

// Obtener la conexión a la base de datos
$pdo = $database->getConnection();

// Función para obtener el vehículo por placa con detalles relacionados
function getVehiculoPorPlaca($placa) {
    global $pdo;

    // Consulta que une varias tablas para obtener todos los detalles del vehículo
    $stmt = $pdo->prepare("
        SELECT 
            v.numeroPlaca, 
            v.marcaVehiculo, 
            v.modeloVehiculo, 
            v.colorVehiculo, 
            v.fechaFabricacion,
            p.nombrePropietario, 
            p.cedulaPropietario, 
            a.nombreAseguradora, 
            a.polizaSeguro,
            et.capacidadDelMotor, 
            et.numeroCilindros, 
            et.pesoVehiculo, 
            tv.tipoVehiculo, 
            tc.tipoCombustible, 
            tt.tipoTransmision
        FROM Vehiculo v
        INNER JOIN Propietario p ON v.idPropietario = p.idPropietario
        INNER JOIN Aseguradora a ON v.idAseguradora = a.idAseguradora
        INNER JOIN EspecificacionesTecnicas et ON v.idVehiculo = et.idVehiculo
        INNER JOIN TipoVehiculo tv ON et.idTipoVehiculo = tv.idTipoVehiculo
        INNER JOIN TipoCombustible tc ON et.idTipoCombustible = tc.idTipoCombustible
        INNER JOIN TipoTransmision tt ON et.idTipoTransmision = tt.idTipoTransmision
        WHERE v.numeroPlaca = ?
    ");
    $stmt->execute([$placa]);

    // Retorna los datos del vehículo como un array asociativo
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroPlaca = htmlspecialchars($_POST['numeroPlaca']);
    $vehiculo = getVehiculoPorPlaca($numeroPlaca);
    
    if (!$vehiculo) {
        $mensaje = "Vehículo no encontrado.";
        $claseMensaje = "alert alert-danger";
    } else {
        $mensaje = "Vehículo encontrado con éxito.";
        $claseMensaje = "alert alert-success";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .btn-group {
            margin-top: 20px;
        }
        .alert {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .row {
            margin-bottom: 30px;
        }
        .pdf-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($mensaje)): ?>
            <div class="<?= htmlspecialchars($claseMensaje); ?>">
                <?= htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <?php if ($vehiculo): ?>
            <!-- Mostrar detalles del vehículo -->
            <div class="row">
                <div class="col-md-6">
                    <h4>Detalles del Vehículo</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Placa</strong></td>
                            <td><?= htmlspecialchars($vehiculo['numeroPlaca']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Marca</strong></td>
                            <td><?= htmlspecialchars($vehiculo['marcaVehiculo']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Modelo</strong></td>
                            <td><?= htmlspecialchars($vehiculo['modeloVehiculo']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Color</strong></td>
                            <td><?= htmlspecialchars($vehiculo['colorVehiculo']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fecha de Fabricación</strong></td>
                            <td><?= htmlspecialchars($vehiculo['fechaFabricacion']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Propietario y Aseguradora</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Nombre del Propietario</strong></td>
                            <td><?= htmlspecialchars($vehiculo['nombrePropietario']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Cédula del Propietario</strong></td>
                            <td><?= htmlspecialchars($vehiculo['cedulaPropietario']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Aseguradora</strong></td>
                            <td><?= htmlspecialchars($vehiculo['nombreAseguradora']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Póliza de Seguro</strong></td>
                            <td><?= htmlspecialchars($vehiculo['polizaSeguro']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Mostrar Especificaciones Técnicas -->
            <div class="row">
                <div class="col-md-6">
                    <h4>Especificaciones Técnicas</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Capacidad del Motor</strong></td>
                            <td><?= htmlspecialchars($vehiculo['capacidadDelMotor']); ?> L</td>
                        </tr>
                        <tr>
                            <td><strong>Número de Cilindros</strong></td>
                            <td><?= htmlspecialchars($vehiculo['numeroCilindros']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Peso del Vehículo</strong></td>
                            <td><?= htmlspecialchars($vehiculo['pesoVehiculo']); ?> kg</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Detalles del Vehículo</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>Tipo de Vehículo</strong></td>
                            <td><?= htmlspecialchars($vehiculo['tipoVehiculo']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tipo de Combustible</strong></td>
                            <td><?= htmlspecialchars($vehiculo['tipoCombustible']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tipo de Transmisión</strong></td>
                            <td><?= htmlspecialchars($vehiculo['tipoTransmision']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Opción para descargar el PDF -->
            <div id="pdf-container">
                <a class="btn btn-success" target="_blank">Descargar PDF</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        class PDFGenerator {
            constructor(className) {
                this.elements = document.querySelectorAll(className); // Selecciona todos los elementos con la clase
                const { jsPDF } = window.jspdf;
                this.doc = new jsPDF(); // Crea una nueva instancia de jsPDF
            }

            // Método para generar el contenido del PDF
            generatePDF() {
                let yPosition = 10; // Posición inicial en el eje Y

                // Itera sobre todos los elementos seleccionados con la clase
                this.elements.forEach(element => {
                    this.doc.text(element.innerText, 10, yPosition); // Añadir texto al PDF
                    yPosition += 10; // Espaciado entre las líneas de texto
                });

                this.savePDF();
            }

            // Método para guardar el PDF
            savePDF() {
                this.doc.save('registro_vehicular.pdf'); // Guardar y descargar el PDF
            }
        }

        // Crear una instancia de PDFGenerator y asignar la funcionalidad al botón
        document.getElementById('pdf-container').addEventListener('click', function() {
            const pdfGenerator = new PDFGenerator('.container');
            pdfGenerator.generatePDF();
        });
    </script>



</body>
</html>
