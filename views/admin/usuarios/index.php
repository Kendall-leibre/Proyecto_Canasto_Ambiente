<div class="topbar">
    <h2>Gestión de Usuarios</h2>
</div>

<div class="contenido">

    <!--FILTROS -->
    <div style="margin-bottom:15px; display:flex; gap:10px;">

        <input type="text" id="buscador"
               placeholder="Buscar por ID o nombre">

        <select id="filtroRol">
            <option value="">Todos los roles</option>
            <option value="ADMIN">ADMIN</option>
            <option value="ORDENES">ORDENES</option>
            <option value="MESERO">MESERO</option>
            <option value="CLIENTE">CLIENTE</option>
        </select>

        <select id="filtroEstado">
            <option value="">Todos los estados</option>
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>
        </select>

    </div>

    <!--AGREGAR USUARIOS -->
    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">

    <form method="GET" action="<?= BASE_URL ?>index.php">
        <input type="hidden" name="controller" value="usuario">
        <input type="hidden" name="action" value="index">
    </form>

    <a href="<?= BASE_URL ?>index.php?controller=usuario&action=crear">
        <button class="btn-add">+ Crear Usuario</button>
    </a>

</div>


    <div class="tabla-container">

        <table class="tabla-usuarios">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($usuarios as $u): ?>
                    <tr 
                        data-id="<?= $u->IDENTIFICACION ?>"
                        data-nombre="<?= strtolower($u->NOMBRE) ?>"
                        data-rol="<?= $u->ROL ?>"
                        data-estado="<?= $u->ID_ESTADO ?>"
                    >

                        <td><?= $u->IDENTIFICACION ?></td>

                        <td><?= $u->NOMBRE ?></td>

                        <td><?= $u->CORREO ?></td>

                        <!--CAMBIAR ROL -->
                        <td>
                            <select onchange="cambiarRol(<?= $u->IDENTIFICACION ?>, this.value)">

                                <option value="1" <?= $u->ROL == 'ADMIN' ? 'selected' : '' ?>>ADMIN</option>
                                <option value="2" <?= $u->ROL == 'ORDENES' ? 'selected' : '' ?>>ORDENES</option>
                                <option value="3" <?= $u->ROL == 'MESERO' ? 'selected' : '' ?>>MESERO</option>
                                <option value="4" <?= $u->ROL == 'CLIENTE' ? 'selected' : '' ?>>CLIENTE</option>

                            </select>
                        </td>

                        <!--ESTADO -->
                        <td>
                            <?php if($u->ID_ESTADO == 1): ?>
                                <span class="badge activo">Activo</span>
                            <?php else: ?>
                                <span class="badge inactivo">Inactivo</span>
                            <?php endif; ?>
                        </td>

                        <!--ACCIONES -->
                        <td class="acciones">

                            <span class="icon edit"
                                  onclick="editarUsuario(<?= $u->IDENTIFICACION ?>)">
                                ✏️
                            </span>

                            <span class="icon delete"
                                  onclick="cambiarEstado(<?= $u->IDENTIFICACION ?>, <?= $u->ID_ESTADO ?>)">
                                🔄
                            </span>

                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>