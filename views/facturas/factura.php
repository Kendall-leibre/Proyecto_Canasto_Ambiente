<?php
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != 2) {
    header("Location: /RestauranteCanasto/views/login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Factura #<?= $factura["ID_FACTURA"] ?></h4>
        </div>

        <div class="card-body">

            <p><strong>Pedido:</strong> <?= $factura["ID_PEDIDO"] ?></p>
            <p><strong>Fecha:</strong> <?= $factura["FECHA_FACTURA"] ?></p>

            <hr>

            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($detalle as $item): ?>
                        <tr>
                            <td><?= $item["NOMBRE"] ?></td>
                            <td><?= $item["CANTIDAD"] ?></td>
                            <td>₡<?= number_format($item["PRECIO_UNITARIO"], 2) ?></td>
                            <td>₡<?= number_format($item["SUBTOTAL"], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <hr>

            <?php 
            $iva = $factura["TOTAL"] - $factura["SUBTOTAL"];
            ?>

            <h5>Subtotal: ₡<?= number_format($factura["SUBTOTAL"], 2) ?></h5>
            <h5>IVA (13%): ₡<?= number_format($iva, 2) ?></h5>
            <h4 class="text-success">Total: ₡<?= number_format($factura["TOTAL"], 2) ?></h4>

        </div>
    </div>
        <a href="/RestauranteCanasto/index.php?pagina=productos" 
        class="btn btn-success mt-3">
        + Nuevo pedido
        </a>

</div>

</body>
</html>