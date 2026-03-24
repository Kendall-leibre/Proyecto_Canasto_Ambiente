<?php

require_once __DIR__ . '/../config/Database.php';

class FacturaRepository
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conectar();
    }

    public function obtenerFacturas()
    {
        $sql = "SELECT 
                    f.ID_FACTURA,
                    f.ID_PEDIDO,
                    f.FECHA_FACTURA,
                    f.SUBTOTAL,
                    f.TOTAL,
                    m.NOMBRE AS METODO_PAGO,
                    i.NOMBRE AS IMPUESTO
                FROM CANASTO_FACTURAS_TB f
                LEFT JOIN CANASTO_METODOS_PAGO_TB m 
                    ON f.ID_METODO_PAGO = m.ID_METODO_PAGO
                LEFT JOIN CANASTO_IMPUESTOS_TB i 
                    ON f.ID_IMPUESTO = i.ID_IMPUESTO
                ORDER BY f.FECHA_FACTURA DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearFactura($idPedido)
{
    $sql = "SELECT SUM(SUBTOTAL) as subtotal 
            FROM CANASTO_DETALLE_PEDIDO_TB
            WHERE ID_PEDIDO = ?";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idPedido]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $subtotal = $resultado["subtotal"] ?? 0;

    $impuesto = $subtotal * 0.13;

    $total = $subtotal + $impuesto;

    $sqlInsert = "INSERT INTO CANASTO_FACTURAS_TB
        (ID_PEDIDO, SUBTOTAL, ID_IMPUESTO, TOTAL, ID_METODO_PAGO, ID_ESTADO)
        VALUES (?, ?, 1, ?, 1, 7)";

    $stmt = $this->db->prepare($sqlInsert);
    $stmt->execute([$idPedido, $subtotal, $total]);
}

    public function obtenerFacturaPorPedido($id)
    {
        $sql = "SELECT * FROM CANASTO_FACTURAS_TB WHERE ID_PEDIDO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDetalleFactura($id)
    {
        $sql = "SELECT d.*, p.NOMBRE
                FROM CANASTO_DETALLE_PEDIDO_TB d
                JOIN CANASTO_PRODUCTOS_TB p 
                ON d.ID_PRODUCTO = p.ID_PRODUCTO
                WHERE d.ID_PEDIDO = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}