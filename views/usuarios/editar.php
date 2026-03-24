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
    <title>Editar Usuario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
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
        <span class="navbar-brand">Restaurante El Canasto - Admin</span>

        <a href="index.php?pagina=usuarios" class="btn btn-light btn-sm">
            ← Volver
        </a>
    </div>
</nav>

<div class="container">

    <div class="card shadow p-4">

        <h3 class="mb-4">Editar Usuario</h3>

        <form method="POST" action="index.php?pagina=actualizarUsuario">

            <input type="hidden" name="id" value="<?= $usuario["IDENTIFICACION"] ?>">

            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?= $usuario["NOMBRE"] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Correo:</label>
                <input type="email" name="correo" class="form-control" value="<?= $usuario["CORREO"] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Rol:</label>
                <select name="rol" class="form-select">
                    <option value="1" <?= $usuario["ID_ROL"] == 1 ? "selected" : "" ?>>Admin</option>
                    <option value="2" <?= $usuario["ID_ROL"] == 2 ? "selected" : "" ?>>Mesero</option>
                    <option value="3" <?= $usuario["ID_ROL"] == 3 ? "selected" : "" ?>>Cliente</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar cambios</button>

        </form>

    </div>

</div>

</body>
</html>