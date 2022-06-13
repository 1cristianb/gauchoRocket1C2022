<?php

class VuelosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function  traerTodosLosVuelos(){
        return $this->database->query("SELECT grillavuelos.dia,grillavuelos.horario,
        grillavuelos.origen,grillavuelos.destino,nave.modelo,tipodeviaje.descripcion
        FROM grillavuelos 
        inner join nave on grillavuelos.equipoId=nave.id
        inner join tipodeviaje on grillavuelos.tipoDeViajeId=tipodeviaje.id");
    }

    public function buscarVuelo($origen,$destino,$dia) {

        return $this->database->query("SELECT grillavuelos.dia,grillavuelos.horario,
        grillavuelos.origen,grillavuelos.destino,nave.modelo,tipodeviaje.descripcion
        FROM grillavuelos 
        inner join nave on grillavuelos.equipoId=nave.id
        inner join tipodeviaje on grillavuelos.tipoDeViajeId=tipodeviaje.id
      WHERE 
      grillavuelos.origen LIKE '%$origen%' 
    AND grillavuelos.destino LIKE '%$destino%' 
      AND grillavuelos.dia LIKE '%$dia%'");

    }
    public function buscarEscalas($origen,$destino,$dia){
        $destinoDevuelto= $this->database->query("SELECT grillavuelos.dia,grillavuelos.horario,
        grillavuelos.origen,grillavuelos.destino,nave.modelo,tipodeviaje.descripcion
        FROM grillavuelos 
        inner join nave on grillavuelos.equipoId=nave.id
        inner join tipodeviaje on grillavuelos.tipoDeViajeId=tipodeviaje.id
      WHERE 
      grillavuelos.destino LIKE '%$destino%'");


        $origenDevuelto= $this->database->query("SELECT grillavuelos.dia,grillavuelos.horario,
        grillavuelos.origen,grillavuelos.destino,nave.modelo,tipodeviaje.descripcion
        FROM grillavuelos 
        inner join nave on grillavuelos.equipoId=nave.id
        inner join tipodeviaje on grillavuelos.tipoDeViajeId=tipodeviaje.id
      WHERE 
      grillavuelos.destino LIKE '%$origen%'");
    }

}