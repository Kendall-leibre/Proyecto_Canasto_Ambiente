<?php

require_once "config/database.php";
require_once "app/models/Usuario.php";

class UsuarioRepository {

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

   public function login($correo, $contrasena){

    $sql = "SELECT * FROM CANASTO_USUARIOS_TB 
            WHERE CORREO = '$correo' 
            AND CONTRASENA = '$contrasena' 
            AND ID_ESTADO = 1";

    $result = $this->db->query($sql);

    if($result && $result->num_rows == 1){

        $data = $result->fetch_object();

        return new Usuario(
            $data->IDENTIFICACION,
            $data->NOMBRE,
            $data->CORREO,
            $data->ID_ROL
        );
    }

    return null;
}

}