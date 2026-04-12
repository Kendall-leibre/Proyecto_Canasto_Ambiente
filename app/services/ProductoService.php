<?php

require_once "app/repositories/ProductoRepository.php";
require_once "app/models/Producto.php";
require_once "app/repositories/CategoriaRepository.php";
require_once "app/repositories/ModificadorRepository.php";

class ProductoService {

    private $repository;
    private $categoriaRepo;
    private $modificadorRepo;

    public function __construct() {
        $this->repository = new ProductoRepository();
        $this->categoriaRepo = new CategoriaRepository();
        $this->modificadorRepo = new ModificadorRepository();
    }

    /* =========================
       PRODUCTOS
    ========================= */
    public function obtenerTodos() {
        return $this->repository->obtenerTodos();
    }

    public function obtenerPorId($id) {
        return $this->repository->obtenerPorId($id);
    }

    public function guardar($data) {

        if(empty($data['nombre'])) {
            throw new Exception("El nombre es obligatorio");
        }

        if($data['precio'] <= 0) {
            throw new Exception("Precio inválido");
        }

        if(empty($data['categoria'])) {
            throw new Exception("Debe seleccionar categoría");
        }

        $rutaImagen = "";

        if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != "") {

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $rutaRelativa = "public/img/productos/" . $nombreImagen;
            $rutaFisica = __DIR__ . "/../../" . $rutaRelativa;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFisica);

            $rutaImagen = $rutaRelativa;
        }

        $producto = new Producto(
            null,
            $data['nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['categoria'],
            $rutaImagen,
            1
        );

        //GUARDAR PRODUCTO
        $idProducto = $this->repository->guardar($producto);

        // GUARDAR MODIFICADORES DINÁMICOS (SI EXISTEN)
        if(isset($data['modificadores'])){
            $this->guardarModificadores($idProducto, $data['modificadores']);
        }

        return $idProducto;
    }

    public function actualizar($id, $data) {

        $producto = $this->repository->obtenerPorId($id);

        if(!$producto){
            throw new Exception("Producto no encontrado");
        }

        $producto->setNombre($data['nombre']);
        $producto->setDescripcion($data['descripcion']);
        $producto->setPrecio($data['precio']);
        $producto->setIdCategoria($data['categoria']);

        return $this->repository->actualizar($producto);
    }

    public function eliminar($id) {
        return $this->repository->eliminar($id);
    }

    /* =========================
       CATEGORÍAS
    ========================= */
    public function obtenerCategorias() {
        return $this->categoriaRepo->obtenerTodas();
    }

    /* =========================
       MODIFICADORES DINÁMICOS
    ========================= */
    public function guardarModificadores($idProducto, $modificadores){

        foreach($modificadores as $mod){

            if(empty($mod['nombre'])) continue;

            //reglas
            $min = ($mod['tipo'] == 'radio') ? 1 : 0;
            $max = ($mod['tipo'] == 'radio') ? 1 : 99;

            // 1. CREAR MODIFICADOR
            $idMod = $this->modificadorRepo->crear(
                $mod['nombre'],
                $min,
                $max
            );

            // 2. ASIGNAR A PRODUCTO
            $this->modificadorRepo->asignarAProducto($idProducto, $idMod);

            // 3. GUARDAR OPCIONES
            if(isset($mod['opciones'])){
                foreach($mod['opciones'] as $op){

                    if(empty($op['nombre'])) continue;

                    $precio = $op['precio'] ?? 0;

                    $this->modificadorRepo->crearOpcion(
                        $idMod,
                        $op['nombre'],
                        $precio
                    );
                }
            }
        }
    }

    public function actualizarModificadores($idProducto, $modificadores){

    $modRepo = new ModificadorRepository();

    //BORRAR RELACIÓN ACTUAL
    $this->repository->asignarModificadores($idProducto, []);

    if(!$modificadores) return;

    foreach($modificadores as $mod){

        // crear nuevo modificador
        $idMod = $modRepo->crearModificador(
            $mod['nombre'],
            $mod['tipo'] == 'radio' ? 1 : 0,
            $mod['tipo'] == 'radio' ? 1 : 99
        );

        $modRepo->asignarAProducto($idProducto, $idMod);

        if(isset($mod['opciones'])){
            foreach($mod['opciones'] as $op){
                $modRepo->crearOpcion(
                    $idMod,
                    $op['nombre'],
                    $op['precio'] ?? 0
                );
            }
        }
    }
}

    /* =========================
       OBTENER MODIFICADORES
    ========================= */
    public function obtenerModificadoresConOpciones($idProducto){
        return $this->repository->obtenerModificadoresConOpciones($idProducto);
    }

}