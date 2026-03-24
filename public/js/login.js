function validarLogin() {
  let correo = document.getElementById("correo").value;
  let contrasena = document.getElementById("contrasena").value;

  if (correo === "" || contrasena === "") {
    alert("Debe completar todos los campos");

    return false;
  }

  return true;
}
