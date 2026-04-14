<div class="contenido">

<div class="producto-box">

    <img src="<?= BASE_URL . ($producto->getImagen() ?? 'public/img/default.png') ?>">

    <h2><?= $producto->getNombre() ?></h2>

    <p><?= $producto->getDescripcion() ?></p>

    <h3 class="price">
        ₡<span id="total"><?= number_format($producto->getPrecio(), 0) ?></span>
    </h3>

</div>

<form method="POST"
      action="<?= BASE_URL ?>index.php?controller=pedido&action=guardar"
      id="formPedido">

<input type="hidden" id="precioBase" value="<?= $producto->getPrecio() ?>">

<?php if($modificadores->num_rows > 0): ?>

<?php $actual = null; ?>

<?php while($m = $modificadores->fetch_object()): ?>

<?php if($actual != $m->ID_MODIFICADOR): ?>

<?php if($actual !== null): ?>
    </div></div>
<?php endif; ?>

<div class="mod-box">
    <h4><?= $m->MODIFICADOR ?></h4>
    <div>

<?php $actual = $m->ID_MODIFICADOR; ?>

<?php endif; ?>

<label class="opcion">

<?php if($m->MAX_SELECCION == 1): ?>
    <input type="radio" name="mod_<?= $m->ID_MODIFICADOR ?>" value="<?= $m->PRECIO_EXTRA ?>" class="op">
<?php else: ?>
    <input type="checkbox" name="mod_<?= $m->ID_MODIFICADOR ?>[]" value="<?= $m->PRECIO_EXTRA ?>" class="op">
<?php endif; ?>

<?= $m->OPCION ?>

<?= $m->PRECIO_EXTRA > 0 ? "(+₡".$m->PRECIO_EXTRA.")" : "" ?>

</label>

<?php endwhile; ?>

</div></div>

<?php else: ?>
<p>No tiene configuraciones</p>
<?php endif; ?>

<button class="btn-primary">
    Agregar ₡<span id="totalBtn"><?= number_format($producto->getPrecio(),0) ?></span>
</button>

</form>

</div>

<script>
document.querySelectorAll(".op").forEach(i => {
    i.addEventListener("change", () => {

        let total = parseFloat(document.getElementById("precioBase").value);

        document.querySelectorAll(".op:checked").forEach(c => {
            total += parseFloat(c.value || 0);
        });

        document.getElementById("total").innerText = total.toLocaleString('es-CR');
        document.getElementById("totalBtn").innerText = total.toLocaleString('es-CR');
    });
});
</script>