<?php

class RegistroController
{
    private $printer;
    private $registroModel;

    public function __construct($registroModel,$printer){
        $this->registroModel = $registroModel;
        $this->printer=$printer;
    }

    public function guardarRegistro(){

        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        $registro  = $this->registroModel->guardarRegistro($nombre,$apellido,$email,$password);

        $data = ["registro" => $registro];
        $this->printer->generateView('registroView.html',$data);
    }
    public function execute() {
        $data=[];
        if(isset($_SESSION["email"])){
            $data = ["sesionOn" =>"inline","sesionOn1"=>"none"];
        }else{
            $data = ["sesion" =>"none","sesionOn1"=>"inline"];
        }
      $this->printer->generateView('registroView.html',$data);
    }

}
