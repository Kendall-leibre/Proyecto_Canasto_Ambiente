<?php

require_once "app/services/ProductoService.php";

class ProductoController {

    private $service;

    public function __construct() {
        $this->service = new ProductoService();
    }

    /* =========================
       LISTAR PRODUCTOS
    ========================= */
    public function index() {

        $productos = $this->service->obtenerTodos();
        $categorias = $this->service->obtenerCategorias();

        $content = "views/admin/productos/lista.php";
        require_once "views/admin/layout.php";
    }

    /* =========================
       FORM CREAR
    ========================= */
    public function crear() {

        $categorias = $this->service->obtenerCategorias();

        $content = "views/admin/productos/crear.php";
        require_once "views/admin/layout.php";
    }

    /* =========================
       GUARDAR
    ========================= */
    public function guardar() {

        try {

            // 1. Guardar producto
            $idProducto = $this->service->guardar($_POST);

            // 2. Guardar modificadores
            if(isset($_POST['modificadores'])){
                $this->service->guardarModificadores(
                    $idProducto,
                    $_POST['modificadores']
                );
            }

            header("Location: index.php?controller=producto&action=index&msg=creado");
            exit;

        } catch (Exception $e) {

            echo "<h3>Error al guardar:</h3>";
            echo $e->getMessage();
        }
    }

    /* =========================
       FORM EDITAR
    ========================= */
    public function editar() {

        if (!isset($_GET['id'])) {
            echo "ID no válido";
            return;
        }

        $id = $_GET['id'];

        $producto = $this->service->obtenerPorId($id);
        $categorias = $this->service->obtenerCategorias();
        $modificadores = $this->service->obtenerModificadoresConOpciones($id);

        if (!$producto) {
            echo "Producto no encontrado";
            return;
        }

        $content = "views/admin/productos/editar.php";
        require_once "views/admin/layout.php";
    }

    /* =========================
       ACTUALIZAR
    ========================= */
    public function actualizar() {

        try {

            if (!isset($_POST['id'])) {
                throw new Exception("ID inválido");
            }

            $id = $_POST['id'];

            // 1. Actualizar producto
            $this->service->actualizar($id, $_POST);

            // 2. 🔥 ACTUALIZAR MODIFICADORES COMPLETOS
            $this->service->actualizarModificadores(
                $id,
                $_POST['modificadores'] ?? []
            );

            header("Location: index.php?controller=producto&action=index&msg=actualizado");
            exit;

        } catch (Exception $e) {

            echo "<h3>Error al actualizar:</h3>";
            echo $e->getMessage();
        }
    }

    /* =========================
       ELIMINAR
    ========================= */
    public function eliminar() {

        if (!isset($_GET['id'])) {
            echo "ID no válido";
            return;
        }

        $id = $_GET['id'];

        $this->service->eliminar($id);

        header("Location: index.php?controller=producto&action=index&msg=eliminado");
        exit;
    }

    /* =========================
       VER DETALLE
    ========================= */
    public function ver() {

        if (!isset($_GET['id'])) {
            echo "ID no válido";
            return;
        }

        $id = $_GET['id'];

        $producto = $this->service->obtenerPorId($id);
        $modificadores = $this->service->obtenerModificadoresConOpciones($id);

        if (!$producto) {
            echo "Producto no encontrado";
            return;
        }

        $content = "views/admin/productos/ver.php";
        require_once "views/admin/layout.php";
    }
}