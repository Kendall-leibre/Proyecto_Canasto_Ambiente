<?php

// 🔒 Validar sesión y rol ADMIN
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != 1) {
   header("Location: index.php?pagina=login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        .sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 220px;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar img {
            width: 90px;
        }

        .sidebar h2 {
            margin-top: 10px;
        }

        .user-info {
            margin-bottom: 20px;
            text-align: center;
        }

        .menu a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            margin-bottom: 8px;
            border-radius: 5px;
        }

        .menu a:hover {
            background-color: #575757;
        }

        .main {
            margin-left: 240px;
            padding: 30px;
        }

        .topbar {
            background-color: #8B0000;
            padding: 20px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 200px;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            width: 180px;
        }

        .logout a {
            display: block;
            text-align: center;
            padding: 10px;
            border: 1px solid red;
            color: red;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout a:hover {
            background-color: #ffdddd;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">
        <img src="/RestauranteCanasto/public/img/logo.png">
        <h2>Canasto</h2>
    </div>

    <div class="user-info">
        <strong><?php echo $_SESSION["usuario"]; ?></strong>
        <br>
        <span>Administrador</span>
    </div>

    <nav class="menu">
        <a href="/RestauranteCanasto/index.php?pagina=dashboard_admin">Dashboard</a>
        <a href="/RestauranteCanasto/index.php?pagina=productos">Productos</a>
        <a href="/RestauranteCanasto/index.php?pagina=ordenes">Órdenes</a>
        <a href="/RestauranteCanasto/index.php?pagina=usuarios">Usuarios</a>
        <a href="/RestauranteCanasto/index.php?pagina=facturas">Facturación</a>
    </nav>

    <div class="logout">
        <a href="/RestauranteCanasto/controllers/logout.php">Cerrar sesión</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        Panel Administrador
    </div>

    <div class="cards">

        <div class="card">
            <h3>Productos</h3>
            <p>Administrar menú</p>
        </div>

        <div class="card">
            <h3>Órdenes</h3>
            <p>Control de pedidos</p>
        </div>

        <div class="card">
            <h3>Usuarios</h3>
            <p>Gestión de usuarios</p>
        </div>

        <div class="card">
            <h3>Facturación</h3>
            <p>Control de ventas</p>
        </div>

    </div>
</div>

</body>
</html>