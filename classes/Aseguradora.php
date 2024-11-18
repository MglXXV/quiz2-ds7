<?php

/*

     Clase Asegurado: Equivalente a la Tabla Aseguradora en la base de datos.
*/

class aseguradora {

    private $idAseguradora;
    private $nombreAseguradora;
    private $polizaSeguro;
    private $fechaInicio;
    private $fechaFinal;


    public function __construct($nombreAseguradora,$polizaSeguro,$fechaFinal,$fechaInicio) {
        $this->nombreAseguradora = $nombreAseguradora;
        $this->polizaSeguro = $polizaSeguro;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
    }


   public function getIdAseguradora() {
        return $this->idAseguradora;
   }

   public function getNombreAseguradora() {
        return $this->nombreAseguradora;
   }

   public function getPolizaSeguro() {
        return $this->polizaSeguro;
   }

   public function getFechaInicio() {
        return $this->fechaInicio;
   }

   public function getFechaFinal() {
        return $this->fechaFinal;
   }

}


?>
