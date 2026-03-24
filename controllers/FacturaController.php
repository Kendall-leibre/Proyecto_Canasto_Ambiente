<?php

require_once __DIR__ . '/../repositories/FacturaRepository.php';

class FacturaController
{

    private $repo;

    public function __construct()
    {
        $this->repo = new FacturaRepository();
    }

    public function listar()
    {

        $facturas = $this->repo->obtenerFacturas();
       include __DIR__ . '/../views/facturas/lista.php';
    }

    public function verFactura()
    {
        if (!isset($_GET["id"])) {
            echo "Factura no encontrada";
            exit();
        }

        $idPedido = $_GET["id"];

        $factura = $this->repo->obtenerFacturaPorPedido($idPedido);

         if (!$factura) {
            echo "Factura no encontrada para este pedido.";
            exit();
        }

        $detalle = $this->repo->obtenerDetalleFactura($idPedido);

        include __DIR__ . '/../views/facturas/factura.php';
    }
}
