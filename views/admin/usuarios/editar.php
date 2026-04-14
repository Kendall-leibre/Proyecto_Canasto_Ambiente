
<link rel="stylesheet" href="<?= BASE_URL ?>public/css/form.css">
<div class="topbar">
    <h2>Editar Usuario</h2>
</div>

<div class="contenido">

    <div class="form-container">

        <form id="formEditarUsuario"
              action="<?= BASE_URL ?>index.php?controller=usuario&action=actualizar"
              method="POST">

            <input type="hidden" name="id" value="<?= $usuario->IDENTIFICACION ?>">

            <!-- NOMBRE -->
            <div class="form-group">
                <label>Nombre</label>
                <input type="text"
                       name="nombre"
                       class="form-control"
                       value="<?= $usuario->NOMBRE ?>"
                       required>
            </div>

            <!-- APELLIDO PATERNO -->
            <div class="form-group">
                <label>Apellido Paterno</label>
                <input type="text"
                       name="apellido_paterno"
                       class="form-control"
                       value="<?= $usuario->APELLIDO_PATERNO ?>">
            </div>

            <!-- APELLIDO MATERNO -->
            <div class="form-group">
                <label>Apellido Materno</label>
                <input type="text"
                       name="apellido_materno"
                       class="form-control"
                       value="<?= $usuario->APELLIDO_MATERNO ?>">
            </div>

            <!-- CORREO -->
            <div class="form-group">
                <label>Correo</label>
                <input type="email"
                       name="correo"
                       class="form-control"
                       value="<?= $usuario->CORREO ?>"
                       required>
            </div>

            <!-- CONTRASEÑA -->
            <div class="form-group">
                <label>Contraseña (opcional)</label>
                <input type="password"
                       name="contrasena"
                       class="form-control"
                       placeholder="Dejar vacío para no cambiar">
            </div>

            <!-- ROL -->
            <div class="form-group">
                <label>Rol</label>
                <select name="rol" class="form-control">

                    <option value="1" <?= $usuario->ID_ROL == 1 ? 'selected' : '' ?>>ADMIN</option>
                    <option value="2" <?= $usuario->ID_ROL == 2 ? 'selected' : '' ?>>ORDENES</option>
                    <option value="3" <?= $usuario->ID_ROL == 3 ? 'selected' : '' ?>>MESERO</option>
                    <option value="4" <?= $usuario->ID_ROL == 4 ? 'selected' : '' ?>>CLIENTE</option>

                </select>
            </div>

            <!-- ESTADO -->
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">

                    <option value="1" <?= $usuario->ID_ESTADO == 1 ? 'selected' : '' ?>>Activo</option>
                    <option value="2" <?= $usuario->ID_ESTADO == 2 ? 'selected' : '' ?>>Inactivo</option>

                </select>
            </div>

            <br>

            <!-- BOTONES -->
            <button class="btn-primary">Actualizar Usuario</button>

            <a href="<?= BASE_URL ?>index.php?controller=usuario&action=index">
                <button type="button" class="btn-cancelar">Cancelar</button>
            </a>

        </form>

    </div>

</div>