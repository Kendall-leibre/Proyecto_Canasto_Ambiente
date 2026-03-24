<?php

require_once __DIR__ . "/../repositories/MeseroRepository.php";

class MeseroController
{
    public function dashboard()
    {
        session_start();

        if (!isset($_SESSION["usuario"])) {
            header("Location: /RestauranteCanasto/views/login/login.php");
            exit();
        }

        if ($_SESSION["rol"] != 2) {
            header("Location: /RestauranteCanasto/index.php");
            exit();
        }

        $repo = new MeseroRepository();
        $meseros = $repo->obtenerMeserosDisponibles();

        require __DIR__ . "/../views/meseros/Dashboard.php";
    }
}