<?php

require_once "app/controllers/BaseController.php";
require_once "app/repositories/PedidoRepository.php";

class PedidoController extends BaseController {

    private $repo;

    public function __construct(){
        $this->repo = new PedidoRepository();
    }

    /* =========================
       DASHBOARD / INICIO
    ========================= */
    public function index(){

        $this->validarSesion();

        $totalPedidos = $this->repo->contar();

        $content = "views/admin/dashboard.php";
        require_once "views/admin/layout.php";
    }

    /* =========================
       CREAR PEDIDO (DESDE PRODUCTO)
    ========================= */
    public function crear(){

      

        $content = "views/admin/pedidos/crear.php";
        require_once "views/admin/layout.php";
    }

    /* =========================
       GUARDAR PEDIDO
    ========================= */
    public function guardar(){

        // ⚠️ IMPORTANTE
        // Si esto está activo y no hay sesión → te manda a login
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $usuario = $_SESSION['id'] ?? null;

        if(!$usuario){
            $usuario = 1; // usuario default (cliente)
        }

        $observaciones = $_POST['observaciones'] ?? '';

        try {

            $idPedido = $this->repo->crear($usuario, $observaciones);


            header("Location: index.php?controller=producto&action=index&msg=pedido_ok");
            exit;

        } catch (Exception $e){

            echo "<h3>Error al guardar pedido:</h3>";
            echo $e->getMessage();
        }
    }

    /* =========================
       LISTAR PEDIDOS
    ========================= */
    public function verPedidos(){

        $this->validarSesion();

        $pedidos = $this->repo->obtenerTodos();

        $content = "views/admin/pedidos/lista.php";
        require_once "views/admin/layout.php";
    }

}