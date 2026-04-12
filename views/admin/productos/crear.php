<div class="form-container">

<h2 class="titulo-seccion">Crear Producto</h2>

<form id="formProducto" method="POST"
      action="<?= BASE_URL ?>index.php?controller=producto&action=guardar"
      enctype="multipart/form-data">

    <!-- INFO -->
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Precio</label>
        <input type="number" name="precio" id="precio" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Categoría</label>
        <select name="categoria" id="categoria" class="form-control" required>
            <option value="">Seleccione</option>
            <?php foreach($categorias as $cat): ?>
                <option value="<?= $cat->ID_CATEGORIA ?>">
                    <?= $cat->NOMBRE_CATEGORIA ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Imagen</label>
        <input type="file" name="imagen" id="imagen" class="form-control">
    </div>

    <hr>

    <h3 class="titulo-seccion">Personalización</h3>

    <div id="contenedorModificadores"></div>

    <button type="button" class="btn-add" onclick="agregarModificador()">
        + Agregar pregunta
    </button>

    <br><br>

    <button type="submit" class="btn-primary">Guardar</button>

</form>

</div>

<script>
let contadorMod = 0;
let contadorOpciones = {};

function agregarModificador(){

    let i = contadorMod++;
    contadorOpciones[i] = 0;

    let html = `
    <div class="mod-box" id="mod_${i}">

        <input type="text"
               name="modificadores[${i}][nombre]"
               placeholder="Ej: ¿Cómo lo quieres?"
               class="form-control"
               required>

        <br>

        <select name="modificadores[${i}][tipo]" class="form-control">
            <option value="radio">Selección única</option>
            <option value="checkbox">Selección múltiple</option>
        </select>

        <div id="opciones_${i}" style="margin-top:10px;"></div>

        <button type="button" class="btn-add" onclick="agregarOpcion(${i})">
            + Opción
        </button>

        <button type="button" class="btn-delete" onclick="eliminarMod(${i})">
            Eliminar
        </button>

    </div>
    `;

    document.getElementById("contenedorModificadores")
        .insertAdjacentHTML("beforeend", html);
}

function eliminarMod(id){
    document.getElementById("mod_" + id).remove();
}

function agregarOpcion(modId){

    let i = contadorOpciones[modId]++;

    let html = `
    <div class="opcion">

        <input type="text"
               name="modificadores[${modId}][opciones][${i}][nombre]"
               class="form-control"
               placeholder="Ej: Queso"
               required>

        <input type="number"
               name="modificadores[${modId}][opciones][${i}][precio]"
               class="form-control"
               placeholder="₡ extra"
               value="0">

        <button type="button" class="btn-delete"
                onclick="this.parentElement.remove()">❌</button>

    </div>
    `;

    document.getElementById("opciones_" + modId)
        .insertAdjacentHTML("beforeend", html);
}
</script>