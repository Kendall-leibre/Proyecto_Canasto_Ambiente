<?php

require_once "app/repositories/ProductoRepository.php";
require_once "app/repositories/PedidoRepository.php";

class MeseroController
{
    private $productoRepo;
    private $pedidoRepo;

    public function __construct()
    {
        $this->productoRepo = new ProductoRepository();
        $this->pedidoRepo = new PedidoRepository();
    }

    private function validarMesero()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol']) || (int)$_SESSION['rol'] !== 2) {
            header("Location: " . BASE_URL . "index.php");
            exit;
        }
    }

    public function index()
    {
        $this->validarMesero();
        require_once "views/mesero/dashboard.php";
    }

    public function productos()
    {
        $this->validarMesero();
        $productos = $this->productoRepo->obtenerTodos();
        require_once "views/mesero/productos.php";
    }

    public function nuevoPedido()
    {
        $this->validarMesero();
        $productos = $this->productoRepo->obtenerTodos();
        require_once "views/mesero/nuevoPedido.php";
    }

    public function guardarPedido()
    {
        $this->validarMesero();

        $idMesero = $_SESSION['id'];
        $numeroMesa = $_POST['numero_mesa'] ?? null;
        $observaciones = $_POST['observaciones'] ?? '';
        $productos = $_POST['productos'] ?? [];
        $cantidades = $_POST['cantidades'] ?? [];

        if (empty($numeroMesa) || empty($productos)) {
            $_SESSION['error'] = "Debe indicar la mesa y seleccionar al menos un producto";
            header("Location: " . BASE_URL . "index.php?controller=mesero&action=nuevoPedido");
            exit;
        }

        $idPedido = $this->pedidoRepo->crear($idMesero, $numeroMesa, $observaciones);

        foreach ($productos as $idProducto) {
            $cantidad = isset($cantidades[$idProducto]) ? (int)$cantidades[$idProducto] : 1;

            if ($cantidad > 0) {
                $this->pedidoRepo->agregarDetalle($idPedido, $idProducto, $cantidad);
            }
        }

        header("Location: " . BASE_URL . "index.php?controller=mesero&action=verPedidoMesa&mesa=" . $numeroMesa);
        exit;
    }

    public function verPedidoMesa()
    {
        $this->validarMesero();

        $mesa = $_GET['mesa'] ?? null;
        $pedido = null;

        if ($mesa) {
            $pedido = $this->pedidoRepo->obtenerPedidoPorMesa($mesa);
        }

        require_once "views/mesero/verPedidoMesa.php";
    }

    public function facturaMesa()
    {
        $this->validarMesero();

        $mesa = $_GET['mesa'] ?? null;
        $factura = null;

        if ($mesa) {
            $factura = $this->pedidoRepo->obtenerFacturaPorMesa($mesa);
        }

        require_once "views/mesero/facturaMesa.php";
    }
}