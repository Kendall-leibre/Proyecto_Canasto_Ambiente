<?php

require_once "config/database.php";
require_once "app/models/Producto.php";

class ProductoRepository {

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function obtenerTodos(){
        return $this->db->query("
            SELECT * 
            FROM CANASTO_PRODUCTOS_TB 
            WHERE ID_ESTADO = 1
        ");
    }

    public function obtenerCategorias(){
        return $this->db->query("
            SELECT * 
            FROM CANASTO_CATEGORIAS_MENU_TB 
            WHERE ID_ESTADO = 1
        ");
    }

    public function guardar($producto) {

    $sql = "INSERT INTO CANASTO_PRODUCTOS_TB 
    (NOMBRE, DESCRIPCION, PRECIO, ID_CATEGORIA, IMAGEN_RUTA, ID_ESTADO)
    VALUES (
        '{$producto->getNombre()}',
        '{$producto->getDescripcion()}',
        {$producto->getPrecio()},
        {$producto->getIdCategoria()},
        '{$producto->getImagen()}',
        1
    )";

    $this->db->query($sql);

    return $this->db->insert_id; 
}

    public function obtenerPorId($id){

        $result = $this->db->query("
            SELECT * 
            FROM CANASTO_PRODUCTOS_TB 
            WHERE ID_PRODUCTO = $id
        ");

        if($result && $result->num_rows == 1){

            $data = $result->fetch_object();

            return new Producto(
                $data->ID_PRODUCTO,
                $data->NOMBRE,
                $data->DESCRIPCION,
                $data->PRECIO,
                $data->ID_CATEGORIA,
                $data->IMAGEN_RUTA,
                $data->ID_ESTADO
            );
        }

        return null;
    }

    public function actualizar($producto){

    return $this->db->query("
        UPDATE CANASTO_PRODUCTOS_TB SET
        NOMBRE = '".$this->db->real_escape_string($producto->getNombre())."',
        DESCRIPCION = '".$this->db->real_escape_string($producto->getDescripcion())."',
        PRECIO = ".$producto->getPrecio().",
        ID_CATEGORIA = ".$producto->getIdCategoria().",
        IMAGEN_RUTA = '".$producto->getImagen()."'
        WHERE ID_PRODUCTO = ".$producto->getId()
    );
}

    public function eliminar($id){
        return $this->db->query("
            UPDATE CANASTO_PRODUCTOS_TB 
            SET ID_ESTADO = 2 
            WHERE ID_PRODUCTO = $id
        ");
    }

    /* =========================
       MODIFICADORES POR PRODUCTO
    ========================= */
    public function obtenerModificadoresConOpciones($idProducto){

    return $this->db->query("
        SELECT 
            m.ID_MODIFICADOR,
            m.NOMBRE AS MODIFICADOR,
            m.MIN_SELECCION,
            m.MAX_SELECCION,
            o.ID_OPCION,
            o.NOMBRE AS OPCION,
            o.PRECIO_EXTRA
        FROM CANASTO_MODIFICADORES_TB m
        INNER JOIN CANASTO_PRODUCTO_MODIFICADOR_TB pm 
            ON m.ID_MODIFICADOR = pm.ID_MODIFICADOR
        LEFT JOIN CANASTO_MODIFICADOR_OPCIONES_TB o
            ON m.ID_MODIFICADOR = o.ID_MODIFICADOR
            AND o.ID_ESTADO = 1
        WHERE pm.ID_PRODUCTO = $idProducto
        AND m.ID_ESTADO = 1
        ORDER BY m.ID_MODIFICADOR, o.ID_OPCION
    ");
}

    public function asignarModificadores($idProducto, $modificadores){

        $this->db->query("
            DELETE FROM CANASTO_PRODUCTO_MODIFICADOR_TB 
            WHERE ID_PRODUCTO = $idProducto
        ");

        if(!$modificadores) return;

        foreach ($modificadores as $modId) {

            $this->db->query("
                INSERT INTO CANASTO_PRODUCTO_MODIFICADOR_TB 
                (ID_PRODUCTO, ID_MODIFICADOR)
                VALUES ($idProducto, $modId)
            ");
        }
    }
}