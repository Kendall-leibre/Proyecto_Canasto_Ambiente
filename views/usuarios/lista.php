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
    <title>Usuarios - Admin</title>

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

        <span class="navbar-brand mb-0 h1">
            Restaurante El Canasto - Admin
        </span>

        <a href="/RestauranteCanasto/index.php?pagina=dashboard_admin" class="btn btn-light btn-sm">
            ← Volver
        </a>

    </div>
</nav>


<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold text-dark">
            Usuarios Registrados
        </h2>

        <a href="#" class="btn btn-dark shadow-sm">
            + Agregar Nuevo
        </a>

    </div>


    <table class="table table-hover table-bordered shadow-sm bg-white">

        <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody>

            <?php foreach ($usuarios as $u): ?>

                <tr>

                    <td><?= $u["IDENTIFICACION"] ?></td>

                    <td><?= $u["NOMBRE"] ?></td>

                    <td><?= $u["APELLIDO_PATERNO"] ?></td>

                    <td><?= $u["CORREO"] ?></td>

                    <td><?= $u["ROL"] ?></td> 

                    <td>

                        <a href="/RestauranteCanasto/index.php?pagina=editarUsuario&id=<?= $u["IDENTIFICACION"] ?>" 
                            class="btn btn-warning">
                            Editar
                        </a>

                        <a href="/RestauranteCanasto/index.php?pagina=eliminarUsuario&id=<?= $u["IDENTIFICACION"] ?>" 
                           class="btn btn-outline-danger btn-sm"
                           onclick="return confirm('¿Eliminar usuario?')">
                            Borrar
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

</body>

</html>