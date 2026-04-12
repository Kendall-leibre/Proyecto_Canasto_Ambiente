<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=productos" class="active">Productos</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=nuevoPedido">Nuevo pedido</a>
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
                <h1 style="margin:0;">Productos</h1>
                <p style="margin:8px 0 0 0; color:#666;">Menú disponible para registrar pedidos.</p>
            </div>
        </div>

        <div class="cards">
            <?php while ($p = $productos->fetch_object()): ?>
                <div class="card">
                    <img src="<?= !empty($p->IMAGEN_RUTA) ? BASE_URL . $p->IMAGEN_RUTA : BASE_URL . 'public/img/default-food.png' ?>" alt="<?= htmlspecialchars($p->NOMBRE) ?>">
                    <h3><?= htmlspecialchars($p->NOMBRE) ?></h3>
                    <p class="price">₡<?= number_format($p->PRECIO, 0) ?></p>
                    <p><?= htmlspecialchars($p->DESCRIPCION) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

</body>
</html>