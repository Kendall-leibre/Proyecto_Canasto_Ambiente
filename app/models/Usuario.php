<?php

class Usuario {

    private $id;
    private $nombre;
    private $correo;
    private $rol;
    private $estado;

    public function __construct($id, $nombre, $correo, $rol, $estado){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->rol = $rol;
        $this->estado = $estado;
    }

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getCorreo(){ return $this->correo; }
    public function getRol(){ return $this->rol; }
    public function getEstado(){ return $this->estado; }
}