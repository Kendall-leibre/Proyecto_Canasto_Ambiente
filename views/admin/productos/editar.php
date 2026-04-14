<div class="topbar">
    <h2>Editar Producto</h2>
</div>

<div class="contenido">
<div class="form-container">

<form id="formEditarProducto"
      action="<?= BASE_URL ?>index.php?controller=producto&action=actualizar"
      method="POST"
      enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $producto->getId() ?>">

<!-- INFO -->
<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control"
           value="<?= $producto->getNombre() ?>" required>
</div>

<div class="form-group">
    <label>Descripción</label>
    <textarea name="descripcion" class="form-control"><?= $producto->getDescripcion() ?></textarea>
</div>

<div class="form-group">
    <label>Precio</label>
    <input type="number" name="precio" class="form-control"
           value="<?= $producto->getPrecio() ?>" required>
</div>

<div class="form-group">
    <label>Categoría</label>
    <select name="categoria" class="form-control">
        <?php foreach($categorias as $cat): ?>
            <option value="<?= $cat->ID_CATEGORIA ?>"
                <?= $cat->ID_CATEGORIA == $producto->getIdCategoria() ? 'selected' : '' ?>>
                <?= $cat->NOMBRE_CATEGORIA ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<?php
$rutaImg = $producto->getImagen() ? BASE_URL . $producto->getImagen() : BASE_URL . "public/img/default.png";
?>

<div class="form-group">
    <label>Imagen actual</label><br>

    <img src="<?= $rutaImg ?>"
         style="width:120px; border-radius:10px; margin-bottom:10px;">
</div>

<div class="form-group">
    <label>Cambiar imagen</label>
    <input type="file" name="imagen" class="form-control">
</div>

<hr>

<h3>Personalización</h3>

<div id="contenedorModificadores">

<?php
$mods = [];

if($modificadores && $modificadores->num_rows > 0){
    while($m = $modificadores->fetch_object()){
        $mods[$m->ID_MODIFICADOR]['nombre'] = $m->MODIFICADOR;
        $mods[$m->ID_MODIFICADOR]['max'] = $m->MAX_SELECCION;
        $mods[$m->ID_MODIFICADOR]['opciones'][] = $m;
    }
}
?>

<?php $i=0; foreach($mods as $mod): ?>

<div class="mod-box" id="mod_<?= $i ?>">

<input type="text"
       name="modificadores[<?= $i ?>][nombre]"
       class="form-control"
       value="<?= $mod['nombre'] ?>">

<select name="modificadores[<?= $i ?>][tipo]" class="form-control">
    <option value="radio" <?= $mod['max']==1?'selected':'' ?>>Única</option>
    <option value="checkbox" <?= $mod['max']>1?'selected':'' ?>>Múltiple</option>
</select>

<div id="opciones_<?= $i ?>">

<?php $j=0; foreach($mod['opciones'] as $op): ?>
<div class="opcion">
<input type="text"
name="modificadores[<?= $i ?>][opciones][<?= $j ?>][nombre]"
class="form-control"
value="<?= $op->OPCION ?>">

<input type="number"
name="modificadores[<?= $i ?>][opciones][<?= $j ?>][precio]"
class="form-control"
value="<?= $op->PRECIO_EXTRA ?>">

<button type="button" onclick="this.parentElement.remove()">❌</button>
</div>
<?php $j++; endforeach; ?>

</div>

<button type="button" onclick="agregarOpcion(<?= $i ?>)">+ Opción</button>
<button type="button" onclick="eliminarMod(<?= $i ?>)">Eliminar</button>

</div>

<?php $i++; endforeach; ?>

</div>

<button type="button" onclick="agregarModificador()">+ Nueva pregunta</button>

<br><br>

<button class="btn-primary">Actualizar Producto</button>

<a href="<?= BASE_URL ?>index.php?controller=producto&action=index" class="btn-cancelar">
    Cancelar
</a>

</form>

</div>
</div>

<script>
let contadorMod = <?= $i ?>;
let contadorOpciones = {};

function agregarModificador(){
    let i = contadorMod++;
    contadorOpciones[i]=0;

    let html = `
    <div id="mod_${i}">
        <input type="text" name="modificadores[${i}][nombre]" class="form-control">
        <select name="modificadores[${i}][tipo]" class="form-control">
            <option value="radio">Única</option>
            <option value="checkbox">Múltiple</option>
        </select>
        <div id="opciones_${i}"></div>
        <button type="button" onclick="agregarOpcion(${i})">+ Opción</button>
        <button type="button" onclick="eliminarMod(${i})">Eliminar</button>
    </div>`;
    document.getElementById("contenedorModificadores").insertAdjacentHTML("beforeend", html);
}

function eliminarMod(id){
    document.getElementById("mod_"+id).remove();
}

function agregarOpcion(modId){
    if(!contadorOpciones[modId]) contadorOpciones[modId]=0;
    let i=contadorOpciones[modId]++;

    let html=`
    <div>
        <input type="text" name="modificadores[${modId}][opciones][${i}][nombre]" class="form-control">
        <input type="number" name="modificadores[${modId}][opciones][${i}][precio]" value="0" class="form-control">
        <button type="button" onclick="this.parentElement.remove()">❌</button>
    </div>`;
    document.getElementById("opciones_"+modId).insertAdjacentHTML("beforeend", html);
}
</script>