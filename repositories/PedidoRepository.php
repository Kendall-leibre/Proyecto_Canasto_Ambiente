<?php

require_once __DIR__ . "/../config/Database.php";

class PedidoRepository
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conectar();
    }

    public function crearPedido($identificacion, $observacion)
    {
        $sql = "INSERT INTO CANASTO_PEDIDOS_TB 
                (IDENTIFICACION, OBSERVACIONES, ID_ESTADO) 
                VALUES (?, ?, 3)"; 

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$identificacion, $observacion]);

        return $this->db->lastInsertId();
    }

    public function insertarDetalle($idPedido, $idProducto, $cantidad, $precio)
    {
        $subtotal = $cantidad * $precio;

        $sqlCheck = "SELECT CANTIDAD 
                     FROM CANASTO_DETALLE_PEDIDO_TB 
                     WHERE ID_PEDIDO = ? AND ID_PRODUCTO = ?";

        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute([$idPedido, $idProducto]);

        $existe = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($existe) {

            $nuevaCantidad = $existe["CANTIDAD"] + $cantidad;
            $nuevoSubtotal = $nuevaCantidad * $precio;

            $sqlUpdate = "UPDATE CANASTO_DETALLE_PEDIDO_TB 
                          SET CANTIDAD = ?, SUBTOTAL = ? 
                          WHERE ID_PEDIDO = ? AND ID_PRODUCTO = ?";

            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->execute([$nuevaCantidad, $nuevoSubtotal, $idPedido, $idProducto]);

        } else {

            $sqlInsert = "INSERT INTO CANASTO_DETALLE_PEDIDO_TB
                          (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO_UNITARIO, SUBTOTAL, ID_ESTADO)
                          VALUES (?, ?, ?, ?, ?, 1)";

            $stmtInsert = $this->db->prepare($sqlInsert);
            $stmtInsert->execute([$idPedido, $idProducto, $cantidad, $precio, $subtotal]);
        }
    }

    public function listarTodasLasOrdenes()
    {   
        $sql = "SELECT 
            p.ID_PEDIDO,
            u.NOMBRE AS NOMBRE_CLIENTE,
            u.APELLIDO_PATERNO AS APELLIDO_CLIENTE,
            p.OBSERVACIONES,
            e.DESCRIPCION AS ESTADO,
            p.FECHA_PEDIDO,
            r.NOMBRE AS ROL_USUARIO
            FROM CANASTO_PEDIDOS_TB p
            INNER JOIN CANASTO_USUARIOS_TB u 
            ON p.IDENTIFICACION = u.IDENTIFICACION
            INNER JOIN CANASTO_ESTADOS_TB e 
            ON p.ID_ESTADO = e.ID_ESTADO
            INNER JOIN CANASTO_ROLES_TB r 
            ON u.ID_ROL = r.ID_ROL";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}