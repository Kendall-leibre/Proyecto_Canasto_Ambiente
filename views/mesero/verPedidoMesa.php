<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos por Mesa</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/mesero.css">
</head>
<body class="dashboard-body">

    <aside class="sidebar">
        <div>
            <div class="logo">
                <img src="<?= BASE_URL ?>public/img/logo.png" alt="Logo">
                <div>
                    <div style="font-size: 18px; font-weight: 700;">Canasto</div>
                    <div style="font-size: 14px; color:#666;">Módulo Mesero</div>
                </div>
            </div>

            <div class="user-info">
                <p style="margin:0; color:#666;"><?= htmlspecialchars($_SESSION['usuario']) ?></p>
                <h2 style="margin:8px 0 0 0;">Mesero</h2>
            </div>

            <div class="menu">
                <div style="font-weight:700; margin-bottom:12px; color:#666;">MENÚ</div>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=index">Dashboard</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=productos">Productos</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=nuevoPedido">Nuevo pedido</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=verPedidoMesa" class="active">Pedidos por mesa</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=facturaMesa">Facturas</a>
            </div>
        </div>

        <div style="padding:20px;">
            <a href="<?= BASE_URL ?>index.php?controller=auth&action=logout" style="display:block; text-align:center; background:#0f172a; color:white; padding:14px; border-radius:14px; font-weight:600;">
                Cerrar sesión
            </a>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1 style="margin:0;">Pedidos por mesa</h1>
                <p style="margin:8px 0 0 0; color:#666;">Consultá el detalle del pedido.</p>
            </div>
        </div>

        <div class="form-container" style="max-width:100%; margin-bottom:24px;">
            <form method="GET" action="<?= BASE_URL ?>index.php">
                <input type="hidden" name="controller" value="mesero">
                <input type="hidden" name="action" value="verPedidoMesa">

                <label>Número de mesa</label>
                <input class="form-control" type="number" name="mesa" required>

                <button type="submit">Buscar</button>
            </form>
        </div>

        <?php if ($pedido): ?>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedido['detalle'] as $d): ?>
                            <tr>
                                <td><?= htmlspecialchars($d['NOMBRE']) ?></td>
                                <td><?= $d['CANTIDAD'] ?></td>
                                <td>₡<?= number_format($d['PRECIO_UNITARIO'], 0) ?></td>
                                <td>₡<?= number_format($d['SUBTOTAL'], 0) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="resume-box">
                <p><strong>Mesa:</strong> <?= $pedido['encabezado']['NUMERO_MESA'] ?></p>
                <p><strong>Pedido:</strong> #<?= $pedido['encabezado']['ID_PEDIDO'] ?></p>
                <p><strong>Observaciones:</strong> <?= htmlspecialchars($pedido['encabezado']['OBSERVACIONES']) ?></p>
                <div class="precio-base">Total: ₡<?= number_format($pedido['total'], 0) ?></div>
            </div>
        <?php elseif (isset($_GET['mesa'])): ?>
            <div class="mod-box">
                No se encontró ningún pedido para esa mesa.
            </div>
        <?php endif; ?>
    </main>

</body>
</html>