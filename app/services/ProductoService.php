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

        /* =========================
           IMAGEN
        ========================= */
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

        // GUARDAR PRODUCTO
        $idProducto = $this->repository->guardar($producto);

        // 🔥 GUARDAR MODIFICADORES
        if(isset($data['modificadores']) && is_array($data['modificadores'])){
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

        /* =========================
           IMAGEN (OPCIONAL)
        ========================= */
        if(isset($_FILES['imagen']) && $_FILES['imagen']['name'] != ""){

            $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
            $rutaRelativa = "public/img/productos/" . $nombreImagen;
            $rutaFisica = __DIR__ . "/../../" . $rutaRelativa;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFisica);

            // ⚠️ IMPORTANTE: este método debe existir en el modelo
            if(method_exists($producto, 'setImagen')){
                $producto->setImagen($rutaRelativa);
            }
        }

        // ACTUALIZAR PRODUCTO
        $this->repository->actualizar($producto);

        // 🔥 ACTUALIZAR MODIFICADORES
        if(isset($data['modificadores'])){
            $this->actualizarModificadores($id, $data['modificadores']);
        }

        return true;
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
       MODIFICADORES (GUARDAR)
    ========================= */

    public function guardarModificadores($idProducto, $modificadores){

        foreach($modificadores as $mod){

            if(empty($mod['nombre'])) continue;

            $min = ($mod['tipo'] == 'radio') ? 1 : 0;
            $max = ($mod['tipo'] == 'radio') ? 1 : 99;

            // CREAR MODIFICADOR
            $idMod = $this->modificadorRepo->crearModificador(
                $mod['nombre'],
                $min,
                $max
            );

            // ASIGNAR A PRODUCTO
            $this->modificadorRepo->asignarAProducto($idProducto, $idMod);

            // OPCIONES
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

    /* =========================
       MODIFICADORES (ACTUALIZAR)
    ========================= */

    public function actualizarModificadores($idProducto, $modificadores){

        // 🔥 ELIMINA RELACIONES ACTUALES
        $this->repository->asignarModificadores($idProducto, []);

        if(!$modificadores || !is_array($modificadores)) return;

        foreach($modificadores as $mod){

            if(empty($mod['nombre'])) continue;

            $min = ($mod['tipo'] == 'radio') ? 1 : 0;
            $max = ($mod['tipo'] == 'radio') ? 1 : 99;

            $idMod = $this->modificadorRepo->crearModificador(
                $mod['nombre'],
                $min,
                $max
            );

            $this->modificadorRepo->asignarAProducto($idProducto, $idMod);

            if(isset($mod['opciones'])){
                foreach($mod['opciones'] as $op){

                    if(empty($op['nombre'])) continue;

                    $this->modificadorRepo->crearOpcion(
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