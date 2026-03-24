<?php

require_once __DIR__ . '/../config/Database.php';

class UsuarioRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
    }

    public function login($correo, $contrasena)
    {
        $sql = "SELECT * FROM CANASTO_USUARIOS_TB WHERE CORREO=? AND CONTRASENA=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo, $contrasena]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarUsuarios()
    {
        $sql = "SELECT 
                u.IDENTIFICACION,
                u.NOMBRE,
                u.APELLIDO_PATERNO,
                u.APELLIDO_MATERNO,
                u.CORREO,
                r.NOMBRE AS ROL
            FROM CANASTO_USUARIOS_TB u
            INNER JOIN CANASTO_ROLES_TB r 
                ON u.ID_ROL = r.ID_ROL";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM CANASTO_USUARIOS_TB WHERE IDENTIFICACION = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarUsuario($id, $nombre, $correo, $rol)
    {
        $sql = "UPDATE CANASTO_USUARIOS_TB 
                SET NOMBRE = ?, CORREO = ?, ID_ROL = ?
                WHERE IDENTIFICACION = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$nombre, $correo, $rol, $id]);
    }

    public function listarTodasLasOrdenes()
    {
         $sql = "SELECT 
            p.ID_PEDIDO,
            p.OBSERVACIONES AS MESA,
            p.FECHA_PEDIDO,
            u.NOMBRE AS NOMBRE_CLIENTE,
            u.APELLIDO_PATERNO AS APELLIDO_CLIENTE,
            r.NOMBRE AS ROL_USUARIO,
            e.NOMBRE AS ESTADO
        FROM CANASTO_PEDIDOS_TB p
        INNER JOIN CANASTO_USUARIOS_TB u 
            ON p.IDENTIFICACION = u.IDENTIFICACION
        INNER JOIN CANASTO_ROLES_TB r 
            ON u.ID_ROL = r.ID_ROL
        INNER JOIN CANASTO_ESTADOS_TB e 
            ON p.ID_ESTADO = e.ID_ESTADO
        ORDER BY p.FECHA_PEDIDO DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}