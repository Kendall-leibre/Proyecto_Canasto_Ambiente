<?php

class Usuario {

    private $id;
    private $nombre;
    private $correo;
    private $rol;

    public function __construct($id, $nombre, $correo, $rol){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->rol = $rol;
    }

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getCorreo(){ return $this->correo; }
    public function getRol(){ return $this->rol; }
}