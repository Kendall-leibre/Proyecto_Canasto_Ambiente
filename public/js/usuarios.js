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

    Swal.fire({
        title: '¿Cambiar estado?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí'
    }).then((result) => {

        if(result.isConfirmed){
            window.location.href =
                "index.php?controller=usuario&action=cambiarEstado&id=" 
                + id + "&estado=" + estado;
        }

    });
}

/* =========================
   CAMBIAR ROL
========================= */
function cambiarRol(id, rol){

    Swal.fire({
        title: '¿Cambiar rol?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí'
    }).then((result) => {

        if(result.isConfirmed){
            window.location.href =
                "index.php?controller=usuario&action=cambiarRol&id="
                + id + "&rol=" + rol;
        }

    });
}
/* =========================
    EDITAR USUARIO
========================= */
function editarUsuario(id){
    window.location.href =
        "index.php?controller=usuario&action=editar&id=" + id;
}

/* =========================
    VALIDAR FORMULARIO CREAR/EDITAR USUARIO
========================= */
function validarFormulario(){

    let nombre = document.querySelector("[name='nombre']").value;

    if(nombre === ""){
        Swal.fire("Error", "El nombre es obligatorio", "error");
        return false;
    }

    return true;
}

/* =========================
    FILTRAR USUARIOS
========================= */

function initFiltroUsuarios(){

    const buscador = document.getElementById("buscador");
    const filtroRol = document.getElementById("filtroRol");
    const filtroEstado = document.getElementById("filtroEstado");
    const filas = document.querySelectorAll(".tabla-usuarios tbody tr");

    if(!buscador || !filtroRol || !filtroEstado) return;

    function filtrar(){

        let texto = buscador.value.toLowerCase().trim();
        let rol = filtroRol.value;
        let estado = filtroEstado.value;

        filas.forEach(f => {

            let id = f.dataset.id;
            let nombre = f.dataset.nombre;
            let rolFila = f.dataset.rol;
            let estadoFila = f.dataset.estado;

            let okTexto =
                id.includes(texto) ||
                nombre.includes(texto);

            let okRol = (rol === "" || rol === rolFila);
            let okEstado = (estado === "" || estado === estadoFila);

            f.style.display = (okTexto && okRol && okEstado)
                ? ""
                : "none";
        });
    }

    buscador.addEventListener("input", filtrar);
    filtroRol.addEventListener("change", filtrar);
    filtroEstado.addEventListener("change", filtrar);
}
document.addEventListener("DOMContentLoaded", function(){
    initFiltroUsuarios();
});