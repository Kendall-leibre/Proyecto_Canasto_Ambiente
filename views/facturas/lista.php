<?php
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != 1) {
    header("Location: /RestauranteCanasto/views/login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>Facturación - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }

        .navbar-custom {
            background: #8B0000;
        }

        .table th, .table td {
            text-align: center;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-dark navbar-custom mb-4 shadow">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand">Facturación - Admin</span>
        <a href="/RestauranteCanasto/index.php?pagina=productos"  class="btn btn-light btn-sm">← Volver</a>
    </div>
</nav>

<div class="container">

    <h2 class="fw-bold mb-4">Facturas Generadas</h2>

    <table class="table table-hover table-bordered shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID Factura</th>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php if (empty($facturas)): ?>
                <tr>
                    <td colspan="5">No hay facturas registradas</td>
                </tr>
            <?php else: ?>

                <?php foreach ($facturas as $f): ?>
                    <tr>
                        <td><?= $f["ID_FACTURA"] ?></td>
                        <td><?= $f["ID_PEDIDO"] ?></td>
                        <td><?= $f["FECHA_FACTURA"] ?></td>
                        <td>₡<?= number_format($f["SUBTOTAL"], 2) ?></td>
                        <td>₡<?= number_format($f["TOTAL"], 2) ?></td>
                        <td>
                            <a href="/RestauranteCanasto/index.php?pagina=factura&id=<?= $f["ID_PEDIDO"] ?>" 
                                class="btn btn-sm btn-primary">
                                Ver
                             </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endif; ?>

        </tbody>
    </table>

</div>

</body>
</html>