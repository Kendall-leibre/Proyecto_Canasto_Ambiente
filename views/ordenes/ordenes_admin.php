<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Órdenes - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: #8B0000;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-custom mb-5 shadow">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1">Órdenes - Administrador</span>
        <a href="/RestauranteCanasto/index.php?pagina=dashboard_admin" class="btn btn-light btn-sm">← Volver</a>
    </div>
</nav>

<div class="container">

    <h3 class="mb-4">Órdenes Realizadas</h3>

    <table class="table table-bordered table-striped table-sm shadow-sm">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Rol</th>
                <th>Observación</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
       <tbody>
        <?php foreach ($ordenes as $orden): ?>
        <tr>
            <td><?= $orden['ID_PEDIDO'] ?></td>
            <td><?= $orden['NOMBRE_CLIENTE'] . ' ' . $orden['APELLIDO_CLIENTE'] ?></td>
            <td><?= isset($orden['ROL_USUARIO']) ? $orden['ROL_USUARIO'] : 'No disponible' ?></td>
            <td><?= isset($orden['OBSERVACIONES']) ? $orden['OBSERVACIONES'] : 'No disponible' ?></td>
            <td><?= isset($orden['ESTADO']) ? $orden['ESTADO'] : 'No disponible' ?></td>
            <td><?= isset($orden['FECHA_PEDIDO']) ? $orden['FECHA_PEDIDO'] : 'No disponible' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

</div>

</body>

</html>