<!DOCTYPE html>
<html>

<head>
    <title>Error 404</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/errors.css">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body>

    <div class="error-container">

        <div class="error-box">
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_kcsr6fcp.json" background="transparent"
                speed="1" style="width: 250px; height: 250px; margin:auto;" loop autoplay>
            </lottie-player>

            <div class="error-title">
                Página no encontrada
            </div>

            <div class="error-desc">
                La ruta a la que intentas acceder no existe o no está disponible.
            </div>

            <a href="<?= BASE_URL ?>index.php?controller=producto&action=index" class="btn-error">
                Volver al sistema
            </a>

        </div>

    </div>

</body>

</html>