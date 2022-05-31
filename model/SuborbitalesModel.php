<?php

class SuborbitalesModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function  traerTodosLosVuelos(){
        return $this->database->query("SELECT * from vuelosSuborbitales");
    }
    public function buscarVuelo($valor) {

        return $this->database->query("SELECT * from vuelosSuborbitales 
      WHERE 
      dia LIKE '%$valor%' 
      OR vuelos LIKE '%$valor%' 
      OR equipos LIKE '%$valor%'
      OR duracion LIKE '%$valor%'
      OR partida LIKE '%$valor%'");

    }
}