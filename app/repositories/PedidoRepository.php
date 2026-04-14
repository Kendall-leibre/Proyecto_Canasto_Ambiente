<?php

require_once "config/database.php";
require_once "app/models/Pedido.php";

class PedidoRepository {

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function crear($usuario, $observaciones){

        $sql = "INSERT INTO CANASTO_PEDIDOS_TB 
                (IDENTIFICACION, OBSERVACIONES, ID_ESTADO) 
                VALUES ($usuario, '$observaciones', 3)";

        return $this->db->query($sql);
    }

    public function obtenerTodos(){

        $sql = "SELECT * FROM CANASTO_PEDIDOS_TB ORDER BY FECHA_PEDIDO DESC";
        return $this->db->query($sql);
    }

    public function contar(){
        $sql = "SELECT COUNT(*) as total FROM CANASTO_PEDIDOS_TB";
        return $this->db->query($sql)->fetch_object()->total;
    }
}