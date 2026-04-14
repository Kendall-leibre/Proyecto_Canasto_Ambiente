<?php

require_once "config/Database.php";
require_once "app/models/Usuario.php";

class UsuarioRepository {

    private $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->connect();
    }

    /* =========================
       LOGIN
    ========================= */
    public function login($correo, $contrasena){

        $sql = "SELECT * FROM CANASTO_USUARIOS_TB 
                WHERE CORREO = ? 
                AND CONTRASENA = ?
                AND ID_ESTADO = 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $correo, $contrasena);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result && $result->num_rows == 1){

            $data = $result->fetch_object();

            return new Usuario(
                $data->IDENTIFICACION,
                $data->NOMBRE,
                $data->CORREO,
                $data->ID_ROL,
                $data->ID_ESTADO
            );
        }

        return null;
    }

    /* =========================
       LISTAR USUARIOS
    ========================= */
    public function obtenerTodos(){

    $sql = "SELECT 
                u.IDENTIFICACION,
                u.NOMBRE,
                u.CORREO,
                u.ID_ESTADO,
                r.NOMBRE AS ROL
            FROM CANASTO_USUARIOS_TB u
            INNER JOIN CANASTO_ROLES_TB r 
                ON u.ID_ROL = r.ID_ROL";

    $result = $this->db->query($sql);

    $usuarios = [];

    while($row = $result->fetch_object()){
        $usuarios[] = $row;
    }

    return $usuarios;
}

    /* =========================
       CAMBIAR ESTADO
    ========================= */
    public function cambiarEstado($id, $estado){

        $sql = "UPDATE CANASTO_USUARIOS_TB 
                SET ID_ESTADO = ?
                WHERE IDENTIFICACION = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $estado, $id);

        return $stmt->execute();
    }

    /* =========================
       CAMBIAR ROL
    ========================= */

    public function cambiarRol($id, $rol){

    $sql = "UPDATE CANASTO_USUARIOS_TB 
            SET ID_ROL = ?
            WHERE IDENTIFICACION = ?";

    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ii", $rol, $id);

    return $stmt->execute();
}
/* =========================
    OBTENER POR ID
    ========================= */
public function obtenerPorId($id){

    $sql = "SELECT u.*, r.NOMBRE AS ROL
            FROM CANASTO_USUARIOS_TB u
            JOIN CANASTO_ROLES_TB r ON u.ID_ROL = r.ID_ROL
            WHERE u.IDENTIFICACION = $id";

    $result = $this->db->query($sql);

    if($result && $result->num_rows > 0){
        return $result->fetch_object();
    }

    return null;
}


    /* =========================
       ACTUALIZAR USUARIO
    ========================= */
    public function actualizar($data){

    //CAMBIA CONTRASEÑA
    if(!empty($data['contrasena'])){

        $sql = "UPDATE CANASTO_USUARIOS_TB 
                SET NOMBRE = ?,
                    APELLIDO_PATERNO = ?,
                    APELLIDO_MATERNO = ?,
                    CORREO = ?,
                    CONTRASENA = ?,
                    ID_ROL = ?,
                    ID_ESTADO = ?
                WHERE IDENTIFICACION = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param(
            "sssssiii",
            $data['nombre'],
            $data['apellido_paterno'],
            $data['apellido_materno'],
            $data['correo'],
            $data['contrasena'], 
            $data['rol'],
            $data['estado'],
            $data['id']
        );

    } else {

        //SIN CAMBIAR CONTRASEÑA
        $sql = "UPDATE CANASTO_USUARIOS_TB 
                SET NOMBRE = ?,
                    APELLIDO_PATERNO = ?,
                    APELLIDO_MATERNO = ?,
                    CORREO = ?,
                    ID_ROL = ?,
                    ID_ESTADO = ?
                WHERE IDENTIFICACION = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param(
            "ssssiii",
            $data['nombre'],
            $data['apellido_paterno'],
            $data['apellido_materno'],
            $data['correo'],
            $data['rol'],
            $data['estado'],
            $data['id']
        );
    }

    return $stmt->execute();
}


/* =========================
   INSERTAR USUARIO
========================= */
public function guardar($data){

    $sql = "INSERT INTO CANASTO_USUARIOS_TB 
            (NOMBRE, CORREO, CONTRASENA, ID_ESTADO, ID_ROL)
            VALUES (
                '{$data['nombre']}',
                '{$data['correo']}',
                '{$data['contrasena']}',
                1,
                {$data['rol']}
            )";

    return $this->db->query($sql);
}
}