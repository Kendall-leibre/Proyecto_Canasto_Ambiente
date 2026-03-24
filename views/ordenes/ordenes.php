<?php


if (!isset($_SESSION["usuario"])) {
    header("Location: /RestauranteCanasto/views/login/login.php");
    exit();
}

if ($_SESSION["rol"] != 1 && $_SESSION["rol"] != 2) {
    header("Location: /RestauranteCanasto/index.php");
    exit();
}

$mesa = $_SESSION["mesa"] ?? "No seleccionada";
$mesero = $_SESSION["usuario"];
$carrito = $_SESSION["carrito"] ?? [];
$total = 0;
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-dark mb-4 shadow" style="background:#8B0000;">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand">Orden</span>
        <a href="/RestauranteCanasto/index.php?pagina=productos" class="btn btn-light btn-sm">← Volver</a>
    </div>
</nav>

<div class="container">

   <h4 class="mb-3">Mesa: <?= $mesa ?></h4>
    <form method="POST" action="/RestauranteCanasto/index.php?pagina=ordenes" class="mb-3">
    <label><strong>Seleccione Mesa:</strong></label>
    <select name="mesa" class="form-select w-25" onchange="this.form.submit()">
        <option value="">-- Seleccione --</option>
        <option value="1">Mesa 1</option>
        <option value="2">Mesa 2</option>
        <option value="3">Mesa 3</option>
        <option value="4">Mesa 4</option>
    </select>
</form>
    <h5 class="mb-4">Mesero: <?= $mesero ?></h5>

    <div class="row">

        <?php if (empty($carrito)): ?>
            <p>No hay productos en la orden</p>
        <?php else: ?>

            <?php foreach ($carrito as $item): 
                $cantidad = $item["cantidad"] ?? 1;
                $subtotal = $cantidad * $item["precio"];
                $total += $subtotal;
            ?>

                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm p-3 text-center">

                        <h5><?= $item["nombre"] ?></h5>

                        <p>Cantidad: <?= $cantidad ?></p>

                        <p>₡<?= number_format($item["precio"], 2) ?></p>

                        <p><strong>Subtotal:</strong> ₡<?= number_format($subtotal, 2) ?></p>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    <div class="mt-4">
        <h3>Total: ₡<?= number_format($total, 2) ?></h3>
    </div>

    <?php if (!empty($carrito)): ?>
        <form method="POST" action="/RestauranteCanasto/index.php?pagina=guardarPedido">
            <button class="btn btn-success mt-3">
                Confirmar Pedido
            </button>
        </form>
    <?php endif; ?>

</div>