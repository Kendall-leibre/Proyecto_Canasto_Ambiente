<?php

class Database {

    public static function connect(){
        $host = "localhost";
        $user = "root";
        $pass = "1234";
        $db   = "restaurante_canasto";

        $conn = new mysqli($host, $user, $pass, $db);

        if($conn->connect_error){
            die("Error de conexión: " . $conn->connect_error);
        }

        return $conn;
    }
}