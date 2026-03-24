<?php

require_once __DIR__ . "/../repositories/UsuarioRepository.php";

class LoginController
{
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $correo = $_POST["correo"] ?? '';
            $contrasena = $_POST["contrasena"] ?? '';

            $repo = new UsuarioRepository();
            $usuario = $repo->login($correo, $contrasena);

            if ($usuario) {

                session_start();

                $_SESSION["usuario"] = $usuario["NOMBRE"];
                $_SESSION["id"] = $usuario["IDENTIFICACION"];
                $_SESSION["rol"] = $usuario["ID_ROL"];
              
                $_SESSION["carrito"] = [];

            switch ($usuario["ID_ROL"]) {
            case 1:
            header("Location: /RestauranteCanasto/index.php?pagina=dashboard_admin");
            break;

            case 2:
            header("Location: /RestauranteCanasto/index.php?pagina=productos");
            break;

            case 3:
            header("Location: /RestauranteCanasto/index.php?pagina=productos");
            break;
               }
                exit();

            } else {

                header("Location: /RestauranteCanasto/views/login/login.php?error=1");
                exit();
            }
        }
    }
}


