<?php

require_once "config/database.php";

class CategoriaRepository {

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function obtenerTodas(){
        $sql = "SELECT * FROM CANASTO_CATEGORIAS_MENU_TB WHERE ID_ESTADO = 1";
        $result = $this->db->query($sql);

        $categorias = [];

        while($row = $result->fetch_object()){
            $categorias[] = $row;
        }

        return $categorias;
    }
}