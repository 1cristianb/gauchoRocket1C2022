<?php

class HomeController {
    private $printer;

    public function __construct($printer) {
        $this->printer = $printer;
    }

    public function execute() {
        $data=[];
        if(isset($_SESSION["email"])){
            $data = ["sesionOn" =>"inline","sesionOn1"=>"none"];
        }else{
            $data = ["sesion" =>"none","sesionOn1"=>"inline"];
        }
        $this->printer->generateView('home.html',$data);
    }
}