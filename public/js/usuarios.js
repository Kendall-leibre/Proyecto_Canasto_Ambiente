/* =========================
   EDITAR USUARIO
========================= */
function editarUsuario(id){
    window.location.href =
        "index.php?controller=usuario&action=editar&id=" + id;
}

/* =========================
   CAMBIAR ESTADO
========================= */
function cambiarEstado(id, estado){

    let nuevoEstado = estado == 1 ? 0 : 1;
    let texto = nuevoEstado == 1 ? "activar" : "desactivar";

    Swal.fire({
        title: '¿Seguro?',
        text: "Desea " + texto + " este usuario",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5'
    }).then((result) => {

        if(result.isConfirmed){
            window.location.href =
                "index.php?controller=usuario&action=estado&id=" + id + "&estado=" + nuevoEstado;
        }

    });
}