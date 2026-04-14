<div class="topbar">
    <h2>Crear Usuario</h2>
</div>

<div class="contenido">
<div class="form-container">

<form action="<?= BASE_URL ?>index.php?controller=usuario&action=guardar"
      method="POST"
     onsubmit="return validarFormulario()"></form>>

<div class="form-group">
    <label>Nombre</label>
    <input type="text"
           name="nombre"
           class="form-control"
           placeholder="Ingrese el nombre completo">
</div>

<div class="form-group">
    <label>Correo</label>
    <input type="email"
           name="correo"
           class="form-control"
           placeholder="ejemplo@gmail.com">
</div>

<div class="form-group">
    <label>Contraseña</label>
    <input type="password"
           name="contrasena"
           class="form-control"
           placeholder="Ingrese una contraseña">
</div>

<div class="form-group">
    <label>Rol</label>
    <select name="rol" class="form-control">
        <option value="">Seleccione un rol</option>
        <option value="1">ADMIN</option>
        <option value="2">ORDENES</option>
        <option value="3">MESERO</option>
        <option value="4">CLIENTE</option>
    </select>
</div>

<br>

<button class="btn-primary">Guardar Usuario</button>

<a href="<?= BASE_URL ?>index.php?controller=usuario&action=index">
    <button type="button" class="btn-cancelar">Cancelar</button>
</a>

</form>

</div>
</div>