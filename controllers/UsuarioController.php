<?php

require_once __DIR__ . '/../repositories/UsuarioRepository.php';

class UsuarioController
{
    private $repo;

    public function __construct()
    {
        $this->repo = new UsuarioRepository();
    }

    private function validarAdmin()
    {

        if (!isset($_SESSION["usuario"])) {
            header("Location: /RestauranteCanasto/views/login/login.php");
            exit();
        }

        if ($_SESSION["rol"] != 1) {
            header("Location: /RestauranteCanasto/index.php");
            exit();
        }
    }

    public function listar()
    {
        $this->validarAdmin();

        $usuarios = $this->repo->listarUsuarios();

        require __DIR__ . '/../views/usuarios/lista.php';
    }

    public function crear()
    {
        $this->validarAdmin();

        $nombre = $_POST["nombre"] ?? '';
        $correo = $_POST["correo"] ?? '';
        $contrasena = $_POST["contrasena"] ?? '';
        $rol = $_POST["rol"] ?? 3; 

        if (!empty($nombre) && !empty($correo) && !empty($contrasena)) {
            $this->repo->crearUsuario($nombre, $correo, $contrasena, $rol);
        }

        header("Location: index.php?pagina=usuarios");
        exit();
    }

    public function editar()
    {
        $this->validarAdmin();

        $id = $_GET["id"] ?? null;

        if (!$id) {
        echo "Usuario no encontrado";
        exit();
        }

        $usuario = $this->repo->obtenerPorId($id);

        if (!$usuario) {
        echo "Usuario no encontrado en la base de datos";
         exit();
        }

        require __DIR__ . '/../views/usuarios/editar.php';
    }

     public function actualizar()
    {
        $this->validarAdmin();

        $id = $_POST["id"] ?? null;
        $nombre = $_POST["nombre"] ?? '';
        $correo = $_POST["correo"] ?? '';
        $rol = $_POST["rol"] ?? 3;

        if ($id) {
            $this->repo->editarUsuario($id, $nombre, $correo, $rol);
        }

        header("Location: index.php?pagina=usuarios");
        exit();
    }

    public function eliminar()
    {
        $this->validarAdmin();

        $id = $_GET["id"] ?? null;

        if ($id) {
            $this->repo->eliminarUsuario($id);
        }

        header("Location: index.php?pagina=usuarios");
        exit();
    }
}