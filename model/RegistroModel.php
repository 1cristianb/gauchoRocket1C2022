<?php

class RegistroModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function guardarRegistro($nombre,$apellido,$email,$password)
    {
            if(!empty($this->validarRegistro($nombre,$apellido,$email,$password))){
               $error= $this->validarRegistro($nombre,$apellido,$email,$password);
                $errorJunto = implode(", ", $error);
                $devolverErrores=["errores"=>$errorJunto];
                return $devolverErrores;

            }else{

            $passwordCodificada = md5($password);

            $sql = "INSERT INTO usuario(nombre,apellido,email,contraseña)
                VALUES ('$nombre','$apellido','$email','$passwordCodificada')";

            $this->database->insert($sql);
            $mensaje = ["mensaje" => "Usuario registrado correctamente"];

            return $mensaje;
            }
    }

    function validarRegistro($nombre,$apellido,$email,$password)
    {
        $errores = array();

        $nombreTrabajado =trim(strtolower($nombre));
        $apellidoTrabajado =trim(strtolower($apellido));


        if (empty($nombreTrabajado)) {
            array_push($errores, "El nombre es requerido");
        }
        if (empty($apellidoTrabajado)) {
            array_push($errores, "El apellido es requerido");

        }
        if (empty($email)) {
            array_push($errores, "El email es requerido");
        }

        if($this->validaEmail($email) == false && !empty($email)){
            array_push($errores,"Debe ingresar un email valido");
        }

        if(!empty($this->getEmailDesdeBd($email))){
            array_push($errores,"El email ya está registrado");
        }

        if (empty($password)) {
        array_push($errores, "La password es requerida");
        }

        return $errores;
    }

    function validaEmail($valor){
        if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
            return false;
        }else{
            return true;
        }
    }

    public function  getEmailDesdeBd($email){
        return $this->database->query("SELECT * from usuario where email='$email'");
    }

}