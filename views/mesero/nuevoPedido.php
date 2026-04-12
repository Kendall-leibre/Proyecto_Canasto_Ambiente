<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido</title>
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
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=nuevoPedido" class="active">Nuevo pedido</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=verPedidoMesa">Pedidos por mesa</a>
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
                <h1 style="margin:0;">Nuevo pedido</h1>
                <p style="margin:8px 0 0 0; color:#666;">Registrá pedidos por mesa.</p>
            </div>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div style="background:#fee2e2; color:#991b1b; padding:12px; border-radius:10px; margin-bottom:20px;">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" action="<?= BASE_URL ?>index.php?controller=mesero&action=guardarPedido">
                <label>Número de mesa</label>
                <input class="form-control" type="number" name="numero_mesa" required>

                <label>Observaciones</label>
                <textarea class="form-control" name="observaciones" rows="4"></textarea>

                <h3>Productos</h3>

                <?php while ($p = $productos->fetch_object()): ?>
                    <div class="mod-box">
                        <strong><?= htmlspecialchars($p->NOMBRE) ?></strong><br>
                        <span class="price">₡<?= number_format($p->PRECIO, 0) ?></span><br><br>

                        <div class="opcion">
                            <label>
                                <input type="checkbox" name="productos[]" value="<?= $p->ID_PRODUCTO ?>">
                                Seleccionar
                            </label>

                            <input
                                type="number"
                                name="cantidades[<?= $p->ID_PRODUCTO ?>]"
                                value="1"
                                min="1"
                                style="width:90px;"
                            >
                        </div>
                    </div>
                <?php endwhile; ?>

                <button type="submit" class="btn-add">Guardar pedido</button>
            </form>
        </div>
    </main>

</body>
</html>