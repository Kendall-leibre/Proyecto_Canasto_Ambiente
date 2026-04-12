<?php

class Database {

    public static function connect(){
        $host = "localhost";
        $user = "root";
        $pass = "Melijosepao05.";
        $db   = "restaurante_canasto";
        $port = 3306;

        mysqli_report(MYSQLI_REPORT_OFF);

        $conn = new mysqli($host, $user, $pass, $db, $port);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $conn->set_charset("utf8");
        return $conn;
    }
}