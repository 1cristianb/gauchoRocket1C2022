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
        if(isset($_SESSION["email"])){
            $data = ["sesionOn" =>"inline","sesionOn1"=>"none"];
        }else{
            $data = ["sesion" =>"none","sesionOn1"=>"inline"];
        }
      $this->printer->generateView('vuelosView.html',$data);
    }

}
