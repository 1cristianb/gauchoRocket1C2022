<?php

class LoginModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function iniciarSesion($email,$password){

            if(!empty($this->validarLogin($email,$password))){
                $error= $this->validarLogin($email,$password);
                $errorJunto = implode(", ", $error);
                $devolverErrores=["errores"=>$errorJunto];
                return $devolverErrores;
            }

            if ( !empty($this->getUsuario($email, $password))){
                $_SESSION["email"] = $email;
                header("location:/");
                exit();

            }else{
                $mensaje=["errores"=>"Contraseña  incorrecta"];
                return $mensaje;
            }

    }

    public function cerrarSesion(){

        session_start();
        $_SESSION["email"]="";
        session_destroy();
        header("location:/");
        exit();
    }

    public function validarLogin($email,$password)
    {
        $errores = array();

        if (empty($email)) {
            array_push($errores, "El email es requerido");
        }
        if(empty($this->getEmailDesdeBd($email)) && !empty($email)){
            array_push($errores,"El email no se encuentra registrado");
        }
        if (empty($password)) {
        array_push($errores, "La password es requerida");
        }

        return $errores;
    }

    public function getUsuario($email,$password)
    {
        $password=md5($password);
        $sql="SELECT * FROM usuario where email='$email' and contraseña='$password'";
        return $this->database->query($sql);
    }

    public function  getEmailDesdeBd($email){
        return $this->database->query("SELECT * from usuario where email='$email'");
    }
}
