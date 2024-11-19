<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/registro-vehiculo.css">
</head>
<body>
    <div class="container form-container">
        <h1 class="form-title">Registro de Vehículo</h1>
        <form action="../../../data-process/crud/modulo-vehiculo/procesar-registro-vehiculo.php" method="POST">
            <!-- Número VIN -->
            <div class="mb-3">
                <label for="numeroVin" class="form-label">Número VIN</label>
                <input type="text" id="numeroVin" name="numeroVin" class="form-control" maxlength="17" placeholder="Ingrese el número VIN" required>
            </div>

            <!-- Número de Placa -->
            <div class="mb-3">
                <label for="numeroPlaca" class="form-label">Número de Placa</label>
                <input type="text" id="numeroPlaca" name="numeroPlaca" class="form-control" maxlength="6" placeholder="Ingrese la placa del vehículo" required>
            </div>

            <!-- Marca -->
            <div class="mb-3">
                <label for="marcaVehiculo" class="form-label">Marca del Vehículo</label>
                <input type="text" id="marcaVehiculo" name="marcaVehiculo" class="form-control" maxlength="15" placeholder="Ingrese la marca del vehículo" required>
            </div>

            <!-- Modelo -->
            <div class="mb-3">
                <label for="modeloVehiculo" class="form-label">Modelo del Vehículo</label>
                <input type="text" id="modeloVehiculo" name="modeloVehiculo" class="form-control" maxlength="15" placeholder="Ingrese el modelo del vehículo" required>
            </div>

            <!-- Año de Fabricación -->
            <div class="mb-3">
                <label for="fechaFabricacion" class="form-label">Año de Fabricación</label>
                <input type="date" id="fecha_fabricacion" name="fecha_fabricacion" class="form-control" required value="<?= date('Y-m-d'); ?>">

            </div>

            <!-- Color -->
            <div class="mb-3">
                <label for="colorVehiculo" class="form-label">Color del Vehículo</label>
                <input type="text" id="colorVehiculo" name="colorVehiculo" class="form-control" maxlength="10" placeholder="Ingrese el color del vehículo" required>
            </div>

            <!-- Cédula del Propietario -->
            <div class="mb-3">
                <label for="cedulaPropietario" class="form-label">Cédula del Propietario</label>
                <input type="text" id="cedulaPropietario" name="cedulaPropietario" class="form-control" placeholder="Ejemplo: 0-000-0000" required>
            </div>

            <!-- Aseguradora -->
            <div class="mb-3">
                <label for="aseguradora" class="form-label">Aseguradora</label>
                <select id="aseguradora" name="idAseguradora" class="form-select" required>
                    <option value="" disabled selected>Seleccione una aseguradora</option>
                    <!-- Aquí se insertan dinámicamente las opciones desde la base de datos -->
                    <?php
                    require_once '../../../database/database.php';
                    $db = (new Database())->getConnection();
                    $query = "SELECT idAseguradora, nombreAseguradora FROM Aseguradora";
                    $stmt = $db->query($query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['idAseguradora']}'>{$row['nombreAseguradora']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tipo de Vehículo -->
            <div class="mb-3">
                <label for="tipoVehiculo" class="form-label">Tipo de Vehículo</label>
                <select id="tipoVehiculo" name="idTipoVehiculo" class="form-select" required>
                    <option value="" disabled selected>Seleccione un tipo de vehículo</option>
                    <?php
                    $query = "SELECT idTipoVehiculo, tipoVehiculo FROM TipoVehiculo";
                    $stmt = $db->query($query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['idTipoVehiculo']}'>{$row['tipoVehiculo']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tipo de Transmisión -->
            <div class="mb-3">
                <label for="tipoTransmision" class="form-label">Tipo de Transmisión</label>
                <select id="tipoTransmision" name="idTipoTransmision" class="form-select" required>
                    <option value="" disabled selected>Seleccione un tipo de transmisión</option>
                    <?php
                    $query = "SELECT idTipoTransmision, tipoTransmision FROM TipoTransmision";
                    $stmt = $db->query($query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['idTipoTransmision']}'>{$row['tipoTransmision']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tipo de Combustible -->
            <div class="mb-3">
                <label for="tipoCombustible" class="form-label">Tipo de Combustible</label>
                <select id="tipoCombustible" name="idTipoCombustible" class="form-select" required>
                    <option value="" disabled selected>Seleccione un tipo de combustible</option>
                    <?php
                    $query = "SELECT idTipoCombustible, tipoCombustible FROM TipoCombustible";
                    $stmt = $db->query($query);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['idTipoCombustible']}'>{$row['tipoCombustible']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Capacidad del Motor -->
            <div class="mb-3">
                <label for="capacidadDelMotor" class="form-label">Capacidad del Motor (en Litros)</label>
                <input type="number" id="capacidadDelMotor" name="capacidadDelMotor" class="form-control"  placeholder="Ejemplo: 2" required>
            </div>

            <!-- Número de Cilindros -->
            <div class="mb-3">
                <label for="numeroCilindros" class="form-label">Número de Cilindros</label>
                <input type="number" id="numeroCilindros" name="numeroCilindros" class="form-control" placeholder="Ejemplo: 4" required>
            </div>

            <!-- Peso Vehicular -->
            <div class="mb-3">
                <label for="pesoVehiculo" class="form-label">Peso Vehicular (en kg)</label>
                <input type="number" id="pesoVehiculo" name="pesoVehiculo" class="form-control" placeholder="Ejemplo: 1500" required>
            </div>

            <!-- Botón de envío -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Registrar Vehículo</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
