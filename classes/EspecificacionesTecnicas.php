<?php

class especificacionestecnicas {
    private $capacidadDelMotor;
    private $numeroCilindros;
    private $pesoVehiculo;
    private $idVehiculo;
    private $idTipoVehiculo;
    private $idTipoTransmision;
    private $idTipoCombustible;

    public function __construct($capacidadDelMotor, $numeroCilindros, $pesoVehiculo, $idVehiculo, $idTipoVehiculo, $idTipoTransmision, $idTipoCombustible) {
        $this->capacidadDelMotor = $capacidadDelMotor;
        $this->numeroCilindros = $numeroCilindros;
        $this->pesoVehiculo = $pesoVehiculo;
        $this->idVehiculo = $idVehiculo;
        $this->idTipoVehiculo = $idTipoVehiculo;
        $this->idTipoTransmision = $idTipoTransmision;
        $this->idTipoCombustible = $idTipoCombustible;
    }

    public function getCapacidadDelMotor() {
        return $this->capacidadDelMotor;
    }

    public function getNumeroCilindros() {
        return $this->numeroCilindros;
    }

    public function getPesoVehiculo() {
        return $this->pesoVehiculo;
    }

    public function getIdVehiculo() {
        return $this->idVehiculo;
    }

    public function getIdTipoVehiculo() {
        return $this->idTipoVehiculo;
    }

    public function getIdTipoTransmision() {
        return $this->idTipoTransmision;
    }

    public function getIdTipoCombustible() {
        return $this->idTipoCombustible;
    }

    public function registrarEspecificaciones($db) {
        $query = "INSERT INTO EspecificacionesTecnicas (capacidadDelMotor, numeroCilindros, pesoVehiculo, idVehiculo, idTipoVehiculo, idTipoTransmision, idTipoCombustible)
                  VALUES (:capacidadDelMotor, :numeroCilindros, :pesoVehiculo, :idVehiculo, :idTipoVehiculo, :idTipoTransmision, :idTipoCombustible)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':capacidadDelMotor', $this->capacidadDelMotor);
        $stmt->bindParam(':numeroCilindros', $this->numeroCilindros);
        $stmt->bindParam(':pesoVehiculo', $this->pesoVehiculo);
        $stmt->bindParam(':idVehiculo', $this->idVehiculo);
        $stmt->bindParam(':idTipoVehiculo', $this->idTipoVehiculo);
        $stmt->bindParam(':idTipoTransmision', $this->idTipoTransmision);
        $stmt->bindParam(':idTipoCombustible', $this->idTipoCombustible);

        return $stmt->execute();
    }
}

?>