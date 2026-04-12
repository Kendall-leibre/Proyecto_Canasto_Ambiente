<?php

class BaseController {

    protected function validarSesion(){
        if(!isset($_SESSION['usuario'])){
            header("Location: " . BASE_URL);
            exit;
        }
    }

    protected function esAdmin(){
        return isset($_SESSION['rol']) && $_SESSION['rol'] == 1;
    }

    protected function esMesero(){
        return isset($_SESSION['rol']) && $_SESSION['rol'] == 2;
    }
}