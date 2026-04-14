<?php

require_once "app/repositories/UsuarioRepository.php";

class UsuarioService {

    private $repository;

    public function __construct(){
        $this->repository = new UsuarioRepository(); 
    }

    /* =========================
       OBTENER TODOS
    ========================= */
    public function obtenerTodos(){
        return $this->repository->obtenerTodos();
    }

    /* =========================
       OBTENER POR ID
    ========================= */
    public function obtenerPorId($id){
        return $this->repository->obtenerPorId($id);
    }

    /* =========================
       CAMBIAR ESTADO
    ========================= */
    public function cambiarEstado($id){
        return $this->repository->cambiarEstado($id);
    }

    /* =========================
       CAMBIAR ROL
    ========================= */
    public function cambiarRol($id, $rol){
        return $this->repository->cambiarRol($id, $rol);
    }

    /* =========================
       ACTUALIZAR
    ========================= */
    public function actualizar($data){
        return $this->repository->actualizar($data);
    }
    public function guardar($data){
            return $this->repository->guardar($data);
    }



}