<?php

require_once "app/repositories/UsuarioRepository.php";

class AuthController
{

    private $repo;

    public function __construct()
    {
        $this->repo = new UsuarioRepository();
    }

    public function login()
    {
        require_once "views/auth/login.php";
    }

    public function autenticar()
{
    session_start(); 

    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    $usuario = $this->repo->login($correo, $contrasena);

    if ($usuario) {

        $_SESSION['usuario'] = $usuario->getNombre();
        $_SESSION['rol'] = $usuario->getRol();
        $_SESSION['id'] = $usuario->getId();

        header("Location: " . BASE_URL . "index.php?controller=pedido&action=index");
        exit;

    } else {
        $_SESSION['error'] = "Credenciales incorrectas";
        header("Location: " . BASE_URL . "index.php");
        exit;
    }
}

    public function logout()
    {
        session_destroy();
        header("Location: " . BASE_URL);
    }
}