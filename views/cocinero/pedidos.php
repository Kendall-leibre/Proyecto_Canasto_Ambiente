<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos Cocina</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/cocinero.css">
</head>
<body>

<h1>Pedidos de Cocina</h1>

<?php if (!empty($pedidos)): ?>

    <?php foreach ($pedidos as $pedido): ?>
        <div style="border:1px solid #ccc; margin-bottom:20px; padding:10px;">

            <h3>Pedido #<?= $pedido['ID_PEDIDO'] ?></h3>
            <p>Mesa: <?= $pedido['NUMERO_MESA'] ?></p>
            <p>Estado: <?= $pedido['ID_ESTADO'] ?></p>

            <strong>Productos:</strong>
            <ul>
                <?php foreach ($pedido['DETALLE'] as $item): ?>
                    <li>
                        <?= $item['PRODUCTO'] ?> x<?= $item['CANTIDAD'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- BOTÓN CAMBIAR ESTADO -->
            <form method="POST" action="<?= BASE_URL ?>index.php?controller=cocinero&action=cambiarEstado">
                <input type="hidden" name="id_pedido" value="<?= $pedido['ID_PEDIDO'] ?>">

                <?php if ($pedido['ID_ESTADO'] == 3): ?>
                    <input type="hidden" name="estado" value="4">
                    <button>En proceso</button>
                <?php elseif ($pedido['ID_ESTADO'] == 4): ?>
                    <input type="hidden" name="estado" value="5">
                    <button>Completar</button>
                <?php endif; ?>

            </form>

        </div>
    <?php endforeach; ?>

<?php else: ?>

    <p>No hay pedidos en cocina</p>

<?php endif; ?>

</body>
</html>