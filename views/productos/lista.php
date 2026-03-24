<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Menú El Canasto - Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .product-card {
            border: none;
            transition: transform 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-badge {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .price-tag {
            color: #d9534f;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .navbar-custom {
            background-color: #8B0000;
            color: white;
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-dark navbar-custom mb-5 shadow">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <?php
                if ($_SESSION["rol"] == 1) {
                    echo "Restaurante El Canasto - Admin";
                } elseif ($_SESSION["rol"] == 2) {
                    echo "Restaurante El Canasto - Meseros";
                }
                ?>
            </span>
            <a href="index.php?pagina=cerrarSesion" class="btn btn-light btn-sm">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">Inventario de Productos</h2>
            <?php if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2) { ?>
                <a href="index.php?pagina=crearProducto" class="btn btn-dark shadow-sm">
                    <i class="bi bi-plus-circle"></i> + Agregar Nuevo
                </a>
            <?php } ?>
        </div>

        <div class="row g-4">
            <?php foreach ($productos as $p): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 product-card shadow-sm">

                        <img src="/RestauranteCanasto/public/img/<?= $p["IMAGEN_RUTA"] ?>" class="card-img-top" alt="<?= $p["NOMBRE"] ?>" style="height: 180px; object-fit: cover;">

                        <div class="card-body">

                            <span class="badge bg-secondary mb-2 category-badge">
                                <?= $p["NOMBRE_CATEGORIA"] ?>
                            </span>

                            <h5 class="card-title fw-bold">
                                <?= $p["NOMBRE"] ?>
                            </h5>

                            <p class="card-text text-muted small">
                                <?= substr($p["DESCRIPCION"], 0, 80) ?>...
                            </p>

                            <p class="price-tag mb-3">
                                ₡<?= number_format($p["PRECIO"], 2) ?>
                            </p>

                          
                            <?php if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2) { ?>
                           
                                <?php if ($_SESSION["rol"] == 2) { ?>
                                    <form action="index.php?pagina=agregarCarrito" method="POST">
                                        <input type="hidden" name="id_producto" value="<?= $p["ID_PRODUCTO"] ?>">
                                        <input type="hidden" name="nombre" value="<?= $p["NOMBRE"] ?>">
                                        <input type="hidden" name="precio" value="<?= $p["PRECIO"] ?>">

                                        <button class="btn btn-success btn-sm w-100">
                                            Agregar a la Orden 🛒
                                        </button>
                                    </form>
                                <?php } ?>


                                <?php if ($_SESSION["rol"] == 1) { ?>
                                    <div class="card-footer bg-white border-top-0 d-flex gap-2 pb-3">
                                        <a href="index.php?pagina=editarProducto&id=<?= $p["ID_PRODUCTO"] ?>" class="btn btn-outline-warning btn-sm w-50">
                                            Editar
                                        </a>

                                        <a href="index.php?pagina=eliminarProducto&id=<?= $p["ID_PRODUCTO"] ?>" class="btn btn-outline-danger btn-sm w-50" onclick="return confirm('¿Seguro que quiere borrar este platillo?')">
                                            Borrar
                                        </a>
                                    </div>
                                <?php } ?>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>