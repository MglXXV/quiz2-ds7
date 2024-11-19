<?php

class vehiculo {

    private $numeroVin;
    private $numeroPlaca;
    private $modeloVehiculo;
    private $marcaVehiculo;
    private $colorVehiculo;
    private $fechaFabricacion;
    private $idPropietario;
    private $idAseguradora;

    public function __construct($numeroVin, $numeroPlaca, $modeloVehiculo, $marcaVehiculo, $colorVehiculo, $fechaFabricacion, $idPropietario, $idAseguradora) {
        $this->numeroVin = $numeroVin;
        $this->numeroPlaca = $numeroPlaca;
        $this->modeloVehiculo = $modeloVehiculo;
        $this->marcaVehiculo = $marcaVehiculo;
        $this->colorVehiculo = $colorVehiculo;
        $this->fechaFabricacion = $fechaFabricacion;
        $this->idPropietario = $idPropietario;
        $this->idAseguradora = $idAseguradora;
    }

    public function getNumeroVin() {
        return $this->numeroVin;
    }

    public function getNumeroPlaca() {
        return $this->numeroPlaca;
    }

    public function getModeloVehiculo() {
        return $this->modeloVehiculo;
    }

    public function getMarcaVehiculo() {
        return $this->marcaVehiculo;
    }

    public function getColorVehiculo() {
        return $this->colorVehiculo;
    }

    public function getFechaFabricacion() {
        return $this->fechaFabricacion;
    }

    public function getIdPropietario() {
        return $this->idPropietario;
    }

    public function getIdAseguradora() {
        return $this->idAseguradora;
    }

    public function registrarVehiculo($db) {
        $query = "INSERT INTO Vehiculo (numeroVin, numeroPlaca, modeloVehiculo, marcaVehiculo, colorVehiculo, fechaFabricacion, idPropietario, idAseguradora)
                  VALUES (:numeroVin, :numeroPlaca, :modeloVehiculo, :marcaVehiculo, :colorVehiculo, :fechaFabricacion, :idPropietario, :idAseguradora)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':numeroVin', $this->numeroVin);
        $stmt->bindParam(':numeroPlaca', $this->numeroPlaca);
        $stmt->bindParam(':modeloVehiculo', $this->modeloVehiculo);
        $stmt->bindParam(':marcaVehiculo', $this->marcaVehiculo);
        $stmt->bindParam(':colorVehiculo', $this->colorVehiculo);
        $stmt->bindParam(':fechaFabricacion', $this->fechaFabricacion);
        $stmt->bindParam(':idPropietario', $this->idPropietario);
        $stmt->bindParam(':idAseguradora', $this->idAseguradora);

        return $stmt->execute();
    }
}

?>