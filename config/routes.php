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

    case 'mesero':
        require_once "app/controllers/MeseroController.php";
        $ctrl = new MeseroController();
    break;

    case 'cocinero':
        require_once "app/controllers/CocineroController.php";
        $ctrl = new CocineroController();
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