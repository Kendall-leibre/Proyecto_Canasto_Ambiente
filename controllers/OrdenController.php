<?php

require_once __DIR__ . "/../repositories/PedidoRepository.php";
require_once __DIR__ . "/../repositories/FacturaRepository.php";

class OrdenController
{
    public function ver()
    {
        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?pagina=login");
            exit();
        }

        if ($_SESSION["rol"] != 1 && $_SESSION["rol"] != 2) {
            header("Location: index.php?pagina=login");
            exit();
        }

        if ($_SESSION["rol"] == 1) {
            $repo = new PedidoRepository();
            $ordenes = $repo->listarTodasLasOrdenes(); 
             require __DIR__ . "/../views/ordenes/ordenes_admin.php";  
        } else {

        if (isset($_POST['mesa'])) {
            $_SESSION['mesa'] = $_POST['mesa'];
            }
        
            $mesa = $_SESSION["mesa"] ?? "NO seleccionada";
            $mesero = $_SESSION["usuario"];
            $carrito = $_SESSION["carrito"];
        

            require __DIR__ . "/../views/ordenes/ordenes.php";
        }
    }

    public function guardarPedido()
    {

        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?pagina=login");
            exit();
        }


        if ($_SESSION["rol"] != 1 && $_SESSION["rol"] != 2) {
            header("Location: index.php?pagina=login");
            exit();
        }

        if (!isset($_SESSION["mesa"]) || empty($_SESSION["mesa"])) {
            echo "Debe seleccionar una mesa antes de confirmar el pedido";
            exit();
        }


        $repo = new PedidoRepository();

        $mesero = $_SESSION["id"];
        $mesa = $_SESSION["mesa"];
        $carrito = $_SESSION["carrito"] ?? [];

  
        if (empty($carrito)) {
            header("Location: /RestauranteCanasto/index.php?pagina=productos");
            exit();
        }

        $idPedido = $repo->crearPedido($mesero, "Mesa $mesa");

        foreach ($carrito as $item) {
            $cantidad = $item["cantidad"] ?? 1;

            $repo->insertarDetalle(
                $idPedido,
                $item["id"],
                $cantidad,
                $item["precio"]
            );
        }

        $facturaRepo = new FacturaRepository();
        $facturaRepo->crearFactura($idPedido);

        unset($_SESSION["carrito"]);


        header("Location: /RestauranteCanasto/index.php?pagina=factura&id=" . $idPedido);
        exit();
    }
}
?>