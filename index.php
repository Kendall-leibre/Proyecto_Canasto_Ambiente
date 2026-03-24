<?php

session_start();

require_once "controllers/LoginController.php";
require_once "controllers/ProductoController.php";
require_once "controllers/MeseroController.php";
require_once "controllers/OrdenController.php";
require_once "controllers/UsuarioController.php";
require_once "controllers/FacturaController.php";

$pagina = $_GET["pagina"] ?? null;

if ($pagina) {

    switch ($pagina) {

        case "login":
            $controller = new LoginController();
            $controller->login();
            break;

        case "dashboard_admin":
            include "views/admin/Dashboard.php";
            break;

        case "productos":
            $controller = new ProductoController();
            $controller->listar();
            break;

        case "guardarProducto":

            if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != 1) {
            header("Location: index.php?pagina=login");
            exit();
          }

            $controller = new ProductoController();
            $controller->crear();
            break;

        case "eliminarProducto":
            $controller = new ProductoController();
            $controller->eliminar();
            break;

        case "meseros":
            $controller = new MeseroController();
            $controller->dashboard();
            break;

        case "agregarCarrito":
            $controller = new ProductoController();
            $controller->agregarCarrito();
            break;

        case "ordenes":
            $controller = new OrdenController();
            $controller->ver();
            break;

        case "guardarPedido":
            $controller = new OrdenController();
            $controller->guardarPedido();
            break;

        case "usuarios":
            $controller = new UsuarioController();
            $controller->listar();
            break;

        case "editarUsuario":
            $controller = new UsuarioController();
            $controller->editar();
            break;

        case "actualizarUsuario":
            $controller = new UsuarioController();
            $controller->actualizar();
            break;

        case "eliminarUsuario":
            $controller = new UsuarioController();
            $controller->eliminar();
            break;

        
        case "factura":
            $controller = new FacturaController();
            $controller->verFactura();
             break;

        case "facturas":
        $controller = new FacturaController();
        $controller->listar();
        break;

        case "crearProducto":
        if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != 1) {
        header("Location: index.php?pagina=login");
        exit();
        }

    include "views/productos/crear.php";
    break;

        default:
            include "views/login/login.php";
            break;
    }

} else {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new LoginController();
        $controller->login();
    } else {
        include "views/login/login.php";
    }
}