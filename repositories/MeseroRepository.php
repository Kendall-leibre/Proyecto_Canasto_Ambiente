<?php

require_once __DIR__ . "/../config/Database.php";

class MeseroRepository {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conectar();
    }

    public function obtenerMeserosDisponibles(){

        $sql = "SELECT * FROM CANASTO_MESEROS_TB WHERE ID_ESTADO = 1";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}