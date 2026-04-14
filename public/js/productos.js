/* =========================
   VALIDACIÓN FORM
========================= */
function initValidacionProducto() {

    const form = document.getElementById("formProducto");
    const formEditar = document.getElementById("formEditarProducto");

    const formActivo = form || formEditar;

    if (!formActivo) return;

    formActivo.addEventListener("submit", function (e) {

        let nombre = document.getElementById("nombre")?.value.trim();
        let precio = document.getElementById("precio")?.value;
        let categoria = document.getElementById("categoria")?.value;
        let imagenInput = document.getElementById("imagen");

        let errores = [];

        if (!nombre) errores.push("Ingrese el nombre del producto");

        if (!precio || isNaN(precio) || parseFloat(precio) <= 0) {
            errores.push("Ingrese un precio válido");
        }

        if (!categoria) errores.push("Seleccione una categoría");

        // SOLO validar imagen en CREAR
        if (form && imagenInput && imagenInput.hasAttribute("required") && !imagenInput.value) {
            errores.push("Seleccione una imagen");
        }

        if (errores.length > 0) {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Campos incompletos',
                html: errores.join("<br>")
            });

            return false;
        }

        Swal.fire({
            icon: 'success',
            title: form ? 'Creando producto...' : 'Actualizando producto...',
            showConfirmButton: false,
            timer: 1000
        });

    });
}

/* =========================
   ELIMINAR
========================= */
function confirmarEliminar(id) {

    Swal.fire({
        title: '¿Eliminar producto?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e63946',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if (result.isConfirmed) {
            window.location.href =
                "index.php?controller=producto&action=eliminar&id=" + id;
        }

    });
}

/* =========================
   MENSAJES
========================= */
function initMensajes() {

    const params = new URLSearchParams(window.location.search);
    const msg = params.get("msg");

    if (!msg) return;

    let config = null;

    if (msg === "creado") {
        config = { icon: 'success', title: 'Producto creado' };
    }

    if (msg === "actualizado") {
        config = { icon: 'success', title: 'Producto actualizado' };
    }

    if (msg === "eliminado") {
        config = { icon: 'success', title: 'Producto eliminado' };
    }
    if (msg === "pedido_ok") {
    config = {
        icon: 'success',
        title: 'Producto agregado al pedido'
    };
}

    if (config) Swal.fire(config);

    // limpia URL sin perder controller
    window.history.replaceState({}, document.title, "index.php?controller=producto&action=index");
}

/* =========================
   FILTRO
========================= */
function initFiltroProductos() {

    const buscador = document.getElementById("buscador");
    const filtro = document.getElementById("filtroCategoria");
    const productos = document.querySelectorAll(".producto-item");

    if (!buscador || !filtro || productos.length === 0) return;

    function filtrar() {

        let texto = buscador.value.toLowerCase().trim();
        let categoria = filtro.value;

        productos.forEach(p => {

            let nombre = (p.dataset.nombre || "").toLowerCase();
            let cat = p.dataset.categoria || "";

            let okNombre = nombre.includes(texto);
            let okCategoria = (categoria === "" || categoria === cat);

            p.style.display = (okNombre && okCategoria) ? "block" : "none";
        });
    }

    buscador.addEventListener("input", filtrar);
    filtro.addEventListener("change", filtrar);
}

/* =========================
   VER DETALLE
========================= */
function verProducto(id) {
    window.location.href =
        "index.php?controller=producto&action=ver&id=" + id;
}

/* =========================
   INIT
========================= */
document.addEventListener("DOMContentLoaded", function () {
    initValidacionProducto();
    initMensajes();
    initFiltroProductos();
});