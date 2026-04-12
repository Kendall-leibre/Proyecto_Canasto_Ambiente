<?php

require_once "config/database.php";
require_once "app/models/Pedido.php";

class PedidoRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function crear($usuario, $numeroMesa, $observaciones)
    {
        $usuario = (int)$usuario;
        $numeroMesa = (int)$numeroMesa;
        $observaciones = $this->db->real_escape_string($observaciones);

        $sql = "INSERT INTO CANASTO_PEDIDOS_TB
                (IDENTIFICACION, NUMERO_MESA, OBSERVACIONES, ID_ESTADO)
                VALUES ($usuario, $numeroMesa, '$observaciones', 3)";

        $this->db->query($sql);

        return $this->db->insert_id;
    }

    public function agregarDetalle($idPedido, $idProducto, $cantidad)
    {
        $idPedido = (int)$idPedido;
        $idProducto = (int)$idProducto;
        $cantidad = (int)$cantidad;

        $sqlProducto = "SELECT PRECIO
                        FROM CANASTO_PRODUCTOS_TB
                        WHERE ID_PRODUCTO = $idProducto
                        AND ID_ESTADO = 1";

        $resultado = $this->db->query($sqlProducto);

        if (!$resultado || $resultado->num_rows === 0) {
            return false;
        }

        $producto = $resultado->fetch_object();
        $precioUnitario = (float)$producto->PRECIO;
        $subtotal = $precioUnitario * $cantidad;

        $sql = "INSERT INTO CANASTO_DETALLE_PEDIDO_TB
                (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO_UNITARIO, SUBTOTAL, ID_ESTADO)
                VALUES ($idPedido, $idProducto, $cantidad, $precioUnitario, $subtotal, 3)";

        return $this->db->query($sql);
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * 
                FROM CANASTO_PEDIDOS_TB
                ORDER BY FECHA_PEDIDO DESC";

        return $this->db->query($sql);
    }

    public function obtenerPedidoPorMesa($mesa)
    {
        $mesa = (int)$mesa;

        $sql = "SELECT 
                    p.ID_PEDIDO,
                    p.NUMERO_MESA,
                    p.OBSERVACIONES,
                    p.FECHA_PEDIDO,
                    d.ID_PRODUCTO,
                    pr.NOMBRE,
                    d.CANTIDAD,
                    d.PRECIO_UNITARIO,
                    d.SUBTOTAL
                FROM CANASTO_PEDIDOS_TB p
                INNER JOIN CANASTO_DETALLE_PEDIDO_TB d
                    ON p.ID_PEDIDO = d.ID_PEDIDO
                INNER JOIN CANASTO_PRODUCTOS_TB pr
                    ON d.ID_PRODUCTO = pr.ID_PRODUCTO
                WHERE p.NUMERO_MESA = $mesa
                AND p.ID_ESTADO IN (3, 4, 5, 7, 8)
                ORDER BY p.ID_PEDIDO DESC";

        $resultado = $this->db->query($sql);

        if (!$resultado || $resultado->num_rows === 0) {
            return null;
        }

        $pedido = [
            'encabezado' => null,
            'detalle' => [],
            'total' => 0
        ];

        while ($fila = $resultado->fetch_assoc()) {
            if ($pedido['encabezado'] === null) {
                $pedido['encabezado'] = [
                    'ID_PEDIDO' => $fila['ID_PEDIDO'],
                    'NUMERO_MESA' => $fila['NUMERO_MESA'],
                    'OBSERVACIONES' => $fila['OBSERVACIONES'],
                    'FECHA_PEDIDO' => $fila['FECHA_PEDIDO']
                ];
            }

            $pedido['detalle'][] = $fila;
            $pedido['total'] += $fila['SUBTOTAL'];
        }

        return $pedido;
    }

    public function obtenerFacturaPorMesa($mesa)
    {
        $pedido = $this->obtenerPedidoPorMesa($mesa);

        if (!$pedido) {
            return null;
        }

        $subtotal = $pedido['total'];
        $iva = $subtotal * 0.13;
        $total = $subtotal + $iva;

        return [
            'pedido' => $pedido,
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total
        ];
    }

    public function obtenerPedidosCocina()
{
    $sql = "SELECT 
                p.ID_PEDIDO,
                p.NUMERO_MESA,
                p.OBSERVACIONES,
                p.FECHA_PEDIDO,
                p.ID_ESTADO,
                d.CANTIDAD,
                pr.NOMBRE AS PRODUCTO
            FROM CANASTO_PEDIDOS_TB p
            INNER JOIN CANASTO_DETALLE_PEDIDO_TB d
                ON p.ID_PEDIDO = d.ID_PEDIDO
            INNER JOIN CANASTO_PRODUCTOS_TB pr
                ON d.ID_PRODUCTO = pr.ID_PRODUCTO
            WHERE p.ID_ESTADO IN (3,4)
            ORDER BY p.FECHA_PEDIDO ASC, p.ID_PEDIDO ASC";

    $resultado = $this->db->query($sql);

    $pedidos = [];

    if (!$resultado) {
        return $pedidos;
    }

    while ($fila = $resultado->fetch_assoc()) {
        $idPedido = $fila['ID_PEDIDO'];

        if (!isset($pedidos[$idPedido])) {
            $pedidos[$idPedido] = [
                'ID_PEDIDO' => $fila['ID_PEDIDO'],
                'NUMERO_MESA' => $fila['NUMERO_MESA'],
                'OBSERVACIONES' => $fila['OBSERVACIONES'],
                'FECHA_PEDIDO' => $fila['FECHA_PEDIDO'],
                'ID_ESTADO' => $fila['ID_ESTADO'],
                'DETALLE' => []
            ];
        }

        $pedidos[$idPedido]['DETALLE'][] = [
            'PRODUCTO' => $fila['PRODUCTO'],
            'CANTIDAD' => $fila['CANTIDAD']
        ];
    }

    return $pedidos;
}

public function actualizarEstadoPedido($idPedido, $estado)
{
    $idPedido = (int)$idPedido;
    $estado = (int)$estado;

    $sql = "UPDATE CANASTO_PEDIDOS_TB
            SET ID_ESTADO = $estado
            WHERE ID_PEDIDO = $idPedido";

    return $this->db->query($sql);
}

    public function contar()
    {
        $sql = "SELECT COUNT(*) as total FROM CANASTO_PEDIDOS_TB";
        return $this->db->query($sql)->fetch_object()->total;
    }
}