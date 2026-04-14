<div class="topbar">
    <h2>Gestión de Usuarios</h2>
</div>

<div class="contenido">

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
                    <tr>

                        <td><?= $u->IDENTIFICACION ?></td>

                        <td><?= $u->NOMBRE ?></td>

                        <td><?= $u->CORREO ?></td>

                        <td><?= $u->ROL ?></td>

                        <td>
                            <?php if($u->ID_ESTADO == 1): ?>
                                <span class="badge activo">Activo</span>
                            <?php else: ?>
                                <span class="badge inactivo">Inactivo</span>
                            <?php endif; ?>
                        </td>

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