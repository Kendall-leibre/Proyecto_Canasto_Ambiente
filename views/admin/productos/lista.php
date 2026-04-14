<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>

<body>

<!-- ===================== -->
<!-- TOPBAR -->
<!-- ===================== -->
<div class="topbar">
    <h2>Productos</h2>

    <div style="display:flex; gap:10px; align-items:center;">

        <span class="badge">
            Platillos registrados: <?= $productos->num_rows ?>
        </span>

        <!-- BOTÓN PRODUCTO -->
        <a href="<?= BASE_URL ?>index.php?controller=producto&action=crear">
            <button class="btn-add">+ Producto</button>
        </a>

    </div>
</div>

<!-- ===================== -->
<!-- FILTROS -->
<!-- ===================== -->
<div style="display:flex; gap:15px; margin-bottom:20px; flex-wrap:wrap;">

    <input type="text" id="buscador" placeholder="Buscar producto..."
           class="form-control" style="max-width:250px;">

    <select id="filtroCategoria" class="form-control" style="max-width:200px;">
        <option value="">Todas las categorías</option>

        <?php foreach($categorias as $cat): ?>
            <option value="<?= $cat->ID_CATEGORIA ?>">
                <?= $cat->NOMBRE_CATEGORIA ?>
            </option>
        <?php endforeach; ?>
    </select>

</div>

<!-- ===================== -->
<!-- PRODUCTOS -->
<!-- ===================== -->
<div class="cards" id="contenedorProductos">

<?php while($p = $productos->fetch_object()): ?>

    <div class="card producto-item"
         onclick="verProducto(<?= $p->ID_PRODUCTO ?>)"
         data-nombre="<?= strtolower($p->NOMBRE ?? '') ?>"
         data-categoria="<?= $p->ID_CATEGORIA ?>">

        <img src="<?= BASE_URL . ($p->IMAGEN_RUTA ?? 'public/img/default.png') ?>">

        <h3><?= $p->NOMBRE ?></h3>

        <p class="price">₡<?= number_format($p->PRECIO, 0) ?></p>

        <div class="acciones">

            <a href="<?= BASE_URL ?>index.php?controller=producto&action=editar&id=<?= $p->ID_PRODUCTO ?>">
                <span class="icon edit">✏️</span>
            </a>

            <a href="#" onclick="event.stopPropagation(); confirmarEliminar(<?= $p->ID_PRODUCTO ?>)">
                <span class="icon delete">❌</span>
            </a>

        </div>

    </div>

<?php endwhile; ?>

</div>

</body>
</html>