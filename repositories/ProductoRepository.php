<?php

include_once "config/Database.php";

class ProductoRepository{

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->conectar();
    }

    public function listar(){

        $sql = "SELECT P.*, C.NOMBRE_CATEGORIA
                FROM CANASTO_PRODUCTOS_TB P
                JOIN CANASTO_CATEGORIAS_MENU_TB C
                ON P.ID_CATEGORIA = C.ID_CATEGORIA";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($nombre, $descripcion, $precio, $categoria, $imagen) {
    try {
        $sql = "INSERT INTO CANASTO_PRODUCTOS_TB
                (NOMBRE, DESCRIPCION, PRECIO, ID_CATEGORIA, IMAGEN_RUTA, ID_ESTADO)
                VALUES (?, ?, ?, ?, ?, 1)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $categoria, $imagen]);
        return true;
    } catch (PDOException $e) {
       
        die("Error en la base de datos: " . $e->getMessage());
    }
}

    public function eliminar($id){

        $sql = "DELETE FROM CANASTO_PRODUCTOS_TB WHERE ID_PRODUCTO=?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return true;
    }

}