<?php

require_once "app/services/UsuarioService.php";

class UsuarioController {

    private $service;

    public function __construct(){
        $this->service = new UsuarioService();
    }

    /* =========================
       LISTAR USUARIOS
    ========================= */
    public function index(){

        $usuarios = $this->service->obtenerTodos();

        $content = "views/admin/usuarios/index.php";
        require_once "views/admin/layout.php";
    }

    /* =========================
       CAMBIAR ESTADO
    ========================= */
    public function cambiarEstado(){

        if(!isset($_GET['id']) || !isset($_GET['estado'])){
            echo "Datos inválidos";
            return;
        }

        $this->service->cambiarEstado(
            $_GET['id'],
            $_GET['estado']
        );

        header("Location: index.php?controller=usuario&action=index");
        exit;
    }
    /* =========================
       CAMBIAR ROL
    ========================= */


    public function cambiarRol(){

    if(!isset($_GET['id']) || !isset($_GET['rol'])){
        echo "Datos inválidos";
        return;
    }

    $this->service->cambiarRol(
        $_GET['id'],
        $_GET['rol']
    );

    header("Location: index.php?controller=usuario&action=index");
    exit;
}
    /* =========================
       EDITAR USUARIO
    ========================= */
    public function editar(){

    if(!isset($_GET['id'])){
        echo "ID inválido";
        return;
    }

    $id = $_GET['id'];

    // traer usuario desde BD
    $usuario = $this->service->obtenerPorId($id);

    if(!$usuario){
        echo "Usuario no encontrado";
        return;
    }

    $content = "views/admin/usuarios/editar.php";
    require_once "views/admin/layout.php";
}
/* =========================
       ACTUALIZAR USUARIO
    ========================= */
public function actualizar(){

    try {

        if(!isset($_POST['id'])){
            throw new Exception("ID inválido");
        }

        $this->service->actualizar($_POST);

        header("Location: index.php?controller=usuario&action=index&msg=actualizado");
        exit;

    } catch (Exception $e) {

        echo "<h3>Error al actualizar:</h3>";
        echo $e->getMessage();
    }
}

/* =========================
   CREAR USUARIO
========================= */
public function crear(){

    $content = "views/admin/usuarios/crear.php";
    require_once "views/admin/layout.php";
}

/* =========================
   GUARDAR USUARIO
========================= */
public function guardar(){

    try{

        $this->service->guardar($_POST);

        header("Location: index.php?controller=usuario&action=index&msg=creado");
        exit;

    }catch(Exception $e){

        echo "<h3>Error:</h3>";
        echo $e->getMessage();
    }
}

}