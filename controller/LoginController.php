<?php

class LoginController
{
    private $loginModel;
    private $printer;

    public function __construct($loginModel,$printer){
        $this->loginModel = $loginModel;
        $this->printer=$printer;
    }

    public function iniciarSesion(){

        $email=$_POST["emailLogin"];
        $password=$_POST["passwordLogin"];

        $login=$this->loginModel->iniciarSesion($email,$password);
        $data = ["login" => $login];

        $this->printer->generateView('loginView.html',$data);

    }
    public function cerrarSesion(){

        $this->loginModel->cerrarSesion();

        $this->printer->generateView('loginView.html');

    }

    public function execute() {
        $data=[];
        if(isset($_SESSION["email"])){
            $data = ["sesionOn" =>"inline","sesionOn1"=>"none"];
        }else{
            $data = ["sesion" =>"none","sesionOn1"=>"inline"];
        }
        $this->printer->generateView('loginView.html',$data);
    }

}