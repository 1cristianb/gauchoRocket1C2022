<?php

class SuborbitalesController
{
    private $suborbitalesModel;
    private $printer;

    public function __construct($suborbitalesModel,$printer){
        $this->suborbitalesModel = $suborbitalesModel;
        $this->printer=$printer;
    }



    public function execute() {
        $data=[];
        $vuelos=$this->suborbitalesModel->traerTodosLosVuelos();
        if(isset($_SESSION["email"])){
            $data = ["sesionOn" =>"inline","sesionOn1"=>"none","vuelosDevueltos"=>$vuelos];
        }else{
            $data = ["sesion" =>"none","sesionOn1"=>"inline","vuelosDevueltos"=>$vuelos];
        }
        $this->printer->generateView('suborbitalesView.html',$data);
    }
/*
    public function traerVuelos() {

        $vuelosDevueltos=$this->suborbitalesModel->traerTodosLosVuelos();

        var_dump($vuelosDevueltos);
        $this->printer->generateView('suborbitalesView.html',$vuelosDevueltos);
    }
*/
    public function buscarVuelo() {
        $busqueda=$_POST['buscar'];
        $vuelos=$this->suborbitalesModel->buscarVuelo($busqueda);
        $suborbitales=["vuelos"=>$vuelos];
        $this->printer->generateView('suborbitalesView.html',$suborbitales);
    }

}