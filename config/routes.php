<?php

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$ctrl = null;

switch($controller){

    case 'auth':
        require_once "app/controllers/AuthController.php";
        $ctrl = new AuthController();
    break;

    case 'producto':
        require_once "app/controllers/ProductoController.php";
        $ctrl = new ProductoController();
    break;

    case 'pedido':
        require_once "app/controllers/PedidoController.php";
        $ctrl = new PedidoController();
    break;

    case "usuario":

    require_once "app/controllers/UsuarioController.php";
    $controller = new UsuarioController();

    if($action == "index"){
        $controller->index();
    }

    if($action == "editar"){
        $controller->editar();
    }

    if($action == "estado"){
        $controller->cambiarEstado();
    }

break;

    default:
        require_once "views/errors/404.php";
        exit;
}

/* VALIDAR CONTROLADOR */
if(!$ctrl){
    require_once "views/errors/404.php";
    exit;
}

/* VALIDAR MÉTODO */
if(!method_exists($ctrl, $action)){
    require_once "views/errors/404.php";
    exit;
}

/* EJECUTAR */
$ctrl->$action();