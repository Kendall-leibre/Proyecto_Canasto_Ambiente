<?php

class UsuarioController {

    public function index(){

        // 🔥 SOLO PARA PRUEBA (luego va BD)
        $usuarios = [];

        $content = "views/admin/usuarios/index.php";
        require_once "views/admin/layout.php";
    }

    public function editar(){
        echo "Editar usuario";
    }

    public function cambiarEstado(){
        echo "Cambiar estado";
    }

}