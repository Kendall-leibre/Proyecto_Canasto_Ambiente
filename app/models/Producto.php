<?php

class Producto {

    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $idCategoria;
    private $imagen;
    private $estado;

    public function __construct($id, $nombre, $descripcion, $precio, $idCategoria, $imagen, $estado){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->idCategoria = $idCategoria;
        $this->imagen = $imagen;
        $this->estado = $estado;
    }

    public function getNombre(){ return $this->nombre; }
    public function getDescripcion(){ return $this->descripcion; }
    public function getPrecio(){ return $this->precio; }
    public function getIdCategoria(){ return $this->idCategoria; }
    public function getImagen(){ return $this->imagen; }

    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setDescripcion($descripcion){ $this->descripcion = $descripcion; }
    public function setPrecio($precio){ $this->precio = $precio; }
    public function setIdCategoria($idCategoria){ $this->idCategoria = $idCategoria; }
    public function getId(){ return $this->id; }
}