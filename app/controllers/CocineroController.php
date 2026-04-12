<?php

require_once "app/repositories/PedidoRepository.php";

class CocineroController
{
    private $pedidoRepo;

    public function __construct()
    {
        $this->pedidoRepo = new PedidoRepository();
    }

    private function validarCocinero()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol']) || (int)$_SESSION['rol'] !== 3) {
            header("Location: " . BASE_URL . "index.php");
            exit;
        }
    }

    public function index()
    {
        $this->validarCocinero();

        $pedidos = $this->pedidoRepo->obtenerPedidosCocina();
        require_once "views/cocinero/pedidos.php";
    }

    public function cambiarEstado()
    {
        $this->validarCocinero();

        $idPedido = $_POST['id_pedido'] ?? null;
        $estado = $_POST['estado'] ?? null;

        if ($idPedido && $estado) {
            $this->pedidoRepo->actualizarEstadoPedido($idPedido, $estado);
        }

        header("Location: " . BASE_URL . "index.php?controller=cocinero&action=index");
        exit;
    }
}