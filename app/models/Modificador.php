<?php

class Modificador {

    private $id;
    private $nombre;
    private $descripcion;
    private $min;
    private $max;
    private $estado;

    public function __construct($id,$nombre,$descripcion,$min,$max,$estado){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->min = $min;
        $this->max = $max;
        $this->estado = $estado;
    }

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getDescripcion(){ return $this->descripcion; }
    public function getMin(){ return $this->min; }
    public function getMax(){ return $this->max; }

    public function setNombre($n){ $this->nombre = $n; }
    public function setDescripcion($d){ $this->descripcion = $d; }
    public function setMin($m){ $this->min = $m; }
    public function setMax($m){ $this->max = $m; }
}