<?php
session_start();

if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != 2) {
    header("Location: /RestauranteCanasto/views/login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Meseros - Restaurante El Canasto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark mb-5 shadow" style="background:#8B0000;">
        <div class="container d-flex justify-content-between">
            <span class="navbar-brand">Restaurante El Canasto - Meseros</span>
            <a href="/RestauranteCanasto/controllers/logout.php" class="btn btn-light btn-sm">Cerrar sesión</a>
        </div>
    </nav>

    <div class="container">

        <h2 class="mb-4 fw-bold">Seleccionar mesa</h2>
        <p class="mb-4">Mesero: <strong><?= $_SESSION["usuario"] ?></strong></p>

        <div class="row g-4">

            <?php foreach ($meseros as $m): ?>

                <div class="col-md-4 col-lg-3">
                    <div class="card p-3 text-center shadow-sm">

                        <h5 class="fw-bold mb-2">
                            <?= $m["NOMBRE"] ?> <?= $m["APELLIDO_PATERNO"] ?> <?= $m["APELLIDO_MATERNO"] ?>
                        </h5>

                        <form action="/RestauranteCanasto/index.php" method="GET">
                            <input type="hidden" name="pagina" value="productos">
                            <input type="hidden" name="mesero" value="<?= $m["IDENTIFICACION"] ?>">

                            <select name="mesa" class="form-select mb-3" required>
                                <option value="">Seleccione una mesa</option>
                                <option value="1">Mesa 1</option>
                                <option value="2">Mesa 2</option>
                                <option value="3">Mesa 3</option>
                                <option value="4">Mesa 4</option>
                                <option value="5">Mesa 5</option>
                                <option value="6">Mesa 6</option>
                                <option value="7">Mesa 7</option>
                                <option value="8">Mesa 8</option>
                                <option value="9">Mesa 9</option>
                                <option value="10">Mesa 10</option>
                            </select>

                            <button type="submit" class="btn btn-dark w-100">
                                Tomar orden
                            </button>
                        </form>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>