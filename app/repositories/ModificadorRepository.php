<?php

require_once "config/database.php";

class ModificadorRepository {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    /* =========================
       CREAR MODIFICADOR
    ========================= */
  public function crearModificador($nombre, $min, $max){

    $nombre = $this->db->real_escape_string($nombre);
    $min = (int)$min;
    $max = (int)$max;

    $sql = "INSERT INTO CANASTO_MODIFICADORES_TB 
            (NOMBRE, MIN_SELECCION, MAX_SELECCION, ID_ESTADO)
            VALUES ('$nombre', $min, $max, 1)";

    $this->db->query($sql);

    return $this->db->insert_id;
}

    /* =========================
       CREAR OPCION
    ========================= */
    public function crearOpcion($idMod, $nombre, $precio){

    $nombre = $this->db->real_escape_string($nombre);
    $precio = (float)$precio;

    $sql = "INSERT INTO CANASTO_MODIFICADOR_OPCIONES_TB
            (ID_MODIFICADOR, NOMBRE, PRECIO_EXTRA, ID_ESTADO)
            VALUES ($idMod, '$nombre', $precio, 1)";

    return $this->db->query($sql);
}
    /* =========================
       ASIGNAR A PRODUCTO
    ========================= */
    public function asignarAProducto($idProducto, $idMod){

    $sql = "INSERT INTO CANASTO_PRODUCTO_MODIFICADOR_TB
            (ID_PRODUCTO, ID_MODIFICADOR)
            VALUES ($idProducto, $idMod)";

    return $this->db->query($sql);
}

}