<?php

class propietario {
    private $nombrePropietario;
    private $cedulaPropietario;
    private $contactoPropietario;
    private $direccionPropietario;
    private $idTipoPropietario;

    public function __construct($nombre, $cedula, $contacto, $direccion, $idTipo) {
        $this->nombrePropietario = $nombre;
        $this->cedulaPropietario = $cedula;
        $this->contactoPropietario = $contacto;
        $this->direccionPropietario = $direccion;
        $this->idTipoPropietario = $idTipo;
    }

    public function getNombrePropietario() {
        return $this->nombrePropietario;
    }

    public function getCedulaPropietario() {
        return $this->cedulaPropietario;
    }

    public function getContactoPropietario() {
        return $this->contactoPropietario;
    }

    public function getDireccionPropietario() {
        return $this->direccionPropietario;
    }

    public function getIdTipoPropietario() {
        return $this->idTipoPropietario;
    }
}

?>