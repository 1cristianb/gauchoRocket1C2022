<?php

class VuelosController
{
    private $printer;
    private $vuelosModel;

    public function __construct($vuelosModel,$printer){
        $this->vuelosModel = $vuelosModel;
        $this->printer=$printer;
    }

    public function execute() {
        $data=[];
        $vuelos=$this->vuelosModel->traerTodosLosVuelos();
        if(isset($_SESSION["email"])){
            $data = ["sesionOn" =>"inline","sesionOn1"=>"none","vuelosDevueltos"=>$vuelos];
        }else{
            $data = ["sesion" =>"none","sesionOn1"=>"inline","vuelosDevueltos"=>$vuelos];
        }
        $this->printer->generateView('vuelosView.html',$data);
    }

    public function buscarVuelosDisponibles() {
        $destino=$_POST['destino'];
        $origen=$_POST['origen'];
        $dia=$_POST['dia'];

        $vuelos=$this->vuelosModel->buscarVuelo($origen,$destino,$dia);

        if(isset($_SESSION["email"])){
            $suborbitales = ["sesionOn" =>"inline","sesionOn1"=>"none","vuelos"=>$vuelos];
        }else{
            $suborbitales = ["sesion" =>"none","sesionOn1"=>"inline","vuelos"=>$vuelos];
        }
        $this->printer->generateView('vuelosView.html',$suborbitales);
    }
}
