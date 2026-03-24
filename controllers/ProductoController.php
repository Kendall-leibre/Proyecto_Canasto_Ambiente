<?php

include_once "repositories/ProductoRepository.php";

class ProductoController
{

    public function listar()
    {

        if (isset($_GET["mesero"])) {

            $_SESSION["mesero"] = $_GET["mesero"];
            $_SESSION["mesa"] = $_GET["mesa"];
        }

        $repo = new ProductoRepository();
        $productos = $repo->listar();

        include "views/productos/lista.php";
    }

    public function crear()
    {

        $repo = new ProductoRepository();

        $nombre = $_POST["nombre"] ?? '';
        $descripcion = $_POST["descripcion"] ?? '';
        $precio = $_POST["precio"] ?? 0;
        $categoria = $_POST["categoria"] ?? null;
        $imagen = $_POST["imagen"] ?? 'default.png';

        if (!empty($nombre) && !empty($precio) && !empty($categoria)) {

            $repo->insertar($nombre, $descripcion, $precio, $categoria, $imagen);
        }

        header("Location: index.php?pagina=productos");
        exit();
    }

    public function eliminar()
    {

        $repo = new ProductoRepository();

        $repo->eliminar($_GET["id"]);

        header("Location: index.php?pagina=productos");
        exit();
    }

    public function agregarCarrito()
    {

        $id = $_POST["id_producto"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];

        $producto = [
            "id" => $id,
            "nombre" => $nombre,
            "precio" => $precio
        ];

        if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = [];
     }

        $_SESSION["carrito"][] = $producto;

        header("Location: index.php?pagina=ordenes");
        exit();
    }
}
