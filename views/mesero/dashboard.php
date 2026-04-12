<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mesero</title>
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
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=index" class="active">Dashboard</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=productos">Productos</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=nuevoPedido">Nuevo pedido</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=verPedidoMesa">Pedidos por mesa</a>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=facturaMesa">Facturas</a>
            </div>
        </div>

        <div class="logout-box">
            <a href="<?= BASE_URL ?>index.php?controller=auth&action=logout">
             Cerrar sesión
            </a>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1 style="margin:0;">Dashboard</h1>
                <p style="margin:8px 0 0 0; color:#666;">Gestioná pedidos y facturas de forma rápida.</p>
            </div>
            <div>
                <p style="margin:0;">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></p>
            </div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Productos</h3>
                <p>Consultá el menú disponible.</p>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=productos">
                    <button>Ver menú</button>
                </a>
            </div>

            <div class="card">
                <h3>Nuevo pedido</h3>
                <p>Registrá una orden por mesa.</p>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=nuevoPedido">
                    <button>Crear orden</button>
                </a>
            </div>

            <div class="card">
                <h3>Pedidos por mesa</h3>
                <p>Consultá el detalle de una mesa.</p>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=verPedidoMesa">
                    <button>Consultar</button>
                </a>
            </div>

            <div class="card">
                <h3>Facturas</h3>
                <p>Revisá el total a cobrar.</p>
                <a href="<?= BASE_URL ?>index.php?controller=mesero&action=facturaMesa">
                    <button>Ver factura</button>
                </a>
            </div>
        </div>

        <div style="margin-top:30px;">
            <h2 style="margin-bottom:10px;">Resumen del módulo de mesero</h2>
            <p>Desde este panel podés ver productos, registrar pedidos por mesa y revisar facturas de forma ordenada.</p>
        </div>
    </main>

</body>
</html>