<?php

class Database
{

    private $host = "localhost";
    private $port = "3306";
    private $db   = "restaurante_canasto";
    private $user = "root";
    private $pass = "Melijosepao05.";

    public function conectar()
    {

        try {

            $conexion = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->db;charset=utf8",
                $this->user,
                $this->pass
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;
        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());
        }
    }
}
