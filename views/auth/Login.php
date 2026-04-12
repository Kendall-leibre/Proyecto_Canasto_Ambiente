<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
<link rel="stylesheet" href="<?= BASE_URL ?>public/css/login.css?v=1">
<div class="login-container">
    <div class="login-card">

        <h2>Iniciar Sesión</h2>

        <?php if(isset($_SESSION['error'])): ?>
            <p style="color:red;">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>index.php?controller=auth&action=autenticar" method="POST">

            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>

            <button type="submit">Ingresar</button>

        </form>

    </div>
</div>

</body>
</html>