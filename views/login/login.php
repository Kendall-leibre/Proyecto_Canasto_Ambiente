<!DOCTYPE html>
<html>

<head>

    <title>Login Restaurante</title>

    <link rel="stylesheet" href="/RestauranteCanasto/public/css/styles.css">

    <script src="/RestauranteCanasto/public/js/login.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <?php
    if (isset($_GET['error'])) {
    ?>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Usuario y contraseña no válidos'
            }).then(() => {
                window.history.replaceState(null, null, window.location.pathname);
            });
        </script>

    <?php
    }
    ?>

    <div class="login-container">

        <div class="login-card">

            <h3>Restaurante Canasto</h3>

            <form method="POST" action="/RestauranteCanasto/index.php" onsubmit="return validarLogin()">

                <input type="email" id="correo" name="correo" placeholder="Correo">

                <br><br>

                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña">

                <br><br>

                <button type="submit">Ingresar</button>

            </form>

        </div>

    </div>

</body>