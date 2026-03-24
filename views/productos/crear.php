<!DOCTYPE html>
<html>

<head>

    <title>Crear Producto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

    <nav class="navbar navbar-dark navbar-custom mb-5 shadow">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <?php 
                session_start();
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

    <h2>Nuevo Producto</h2>

    <form method="POST" action="index.php?pagina=guardarProducto">

        <div class="mb-3">

            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control">

        </div>

        <div class="mb-3">

            <label>Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>

        </div>

        <div class="mb-3">

            <label>Precio</label>
            <input type="number" name="precio" class="form-control">

        </div>

        <div class="mb-3">

            <label>Categoría</label>

            <select name="categoria" class="form-control">

                <option value="1">Entradas</option>
                <option value="2">Platos fuertes</option>
                <option value="3">Bebidas</option>

            </select>

        </div>

        <div class="mb-3">

            <label>Nombre imagen</label>
            <input type="text" name="imagen" class="form-control">

        </div>

        <button class="btn btn-primary">Guardar</button>

    </form>

</body>

</html>