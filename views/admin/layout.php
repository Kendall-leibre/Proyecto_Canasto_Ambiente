<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/admin.css">

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JS GLOBAL -->
    <script src="<?= BASE_URL ?>public/js/productos.js"></script>
</head>

<body class="dashboard-body">

<div class="sidebar">

    <div>
        <div class="logo">
            <img src="<?= BASE_URL ?>public/img/logo.png">
            <span>Canasto</span>
        </div>

        <div class="user-info">
            <strong><?= $_SESSION['usuario'] ?? 'Usuario' ?></strong>
            <span>Administrador</span>
        </div>

        <div class="menu">
            <div class="menu-title">MENU</div>

            <a href="<?= BASE_URL ?>index.php?controller=pedido&action=index">
                Dashboard
            </a>

            <a href="<?= BASE_URL ?>index.php?controller=pedido&action=verPedidos">
                Órdenes
            </a>

            <a href="<?= BASE_URL ?>index.php?controller=producto&action=index">
                Productos
            </a>
        </div>
    </div>

    <div class="logout">
        <a href="<?= BASE_URL ?>index.php?controller=auth&action=logout">
            Cerrar sesión
        </a>
    </div>

</div>

<div class="main">

<?php 
if(isset($content)){
    require_once $content;
}else{
    echo "<h3>Error: vista no cargada</h3>";
}
?>

</div>

</body>
</html>