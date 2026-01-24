const botonLogin = document.getElementById('btn-login');
const botonCerrarLogin = document.getElementById('btn-cerrar-login');
const menuLateralLogin = document.getElementById('barra-lateral-login');
const iconoCarrito = document.getElementById('icono-carrito');
const barraLateralCarrito = document.getElementById('barra-lateral-carrito');
const botonCerrarCarrito = document.getElementById('cerrar-carrito');
const capaSuperpuesta = document.getElementById('capa-superpuesta');


document.addEventListener('DOMContentLoaded', () => {
    const menuLateralLogin = document.getElementById('barra-lateral-login');

    if (menuLateralLogin?.dataset.comprobarError === 'true') {
        abrirCerrarLogin();
    }
    if (localStorage.getItem('recien agregado') === 'true') {
        localStorage.setItem('recien agregado', false)
        if (localStorage.getItem('carrito abierto') === 'true') {
            barraLateralCarrito.classList.remove('barra-lateral-cerrado')
            barraLateralCarrito.classList.add('barra-lateral-abierto')
        } else {
            barraLateralCarrito.classList.remove('barra-lateral-abierto')
            barraLateralCarrito.classList.add('barra-lateral-cerrado')
        }
    }

});


//Abrir y cerrar las menús laterales de carrito y login

if (botonLogin) { botonLogin.addEventListener('click', abrirCerrarLogin) }
if (botonCerrarLogin) { botonCerrarLogin.addEventListener('click', abrirCerrarLogin) }
if (iconoCarrito) { iconoCarrito.addEventListener('click', abrirCerrarCarrito) }
if (botonCerrarCarrito) { botonCerrarCarrito.addEventListener('click', abrirCerrarCarrito) }

function cerrarLogin() {
    menuLateralLogin.classList.remove('barra-lateral-abierto')
    menuLateralLogin.classList.add('barra-lateral-cerrado')
    capaSuperpuesta.classList.add('hidden')
}
function cerrarCarrito() {
    barraLateralCarrito.classList.remove('barra-lateral-abierto')
    barraLateralCarrito.classList.add('barra-lateral-cerrado')
    capaSuperpuesta.classList.add('hidden')
}


function abrirCerrarLogin() {
    if (menuLateralLogin.classList.contains('barra-lateral-abierto')) {
        cerrarLogin()
    } else {
        cerrarCarrito()
        menuLateralLogin.classList.remove('barra-lateral-cerrado')
        menuLateralLogin.classList.add('barra-lateral-abierto')
        capaSuperpuesta.classList.remove('hidden')
    }
}

function abrirCerrarCarrito() {
    if (barraLateralCarrito.classList.contains('barra-lateral-abierto')) {
        cerrarCarrito()
    } else {
        cerrarLogin()
        barraLateralCarrito.classList.remove('barra-lateral-cerrado')
        barraLateralCarrito.classList.add('barra-lateral-abierto')
        capaSuperpuesta.classList.remove('hidden')
    }
}



//Modificar cantidad en el carrito

function editarCantidad(indice, accion) {
    fetch(RUTA_WEB + '/modelos/carrito/editar-cantidad-producto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'indice=' + indice + '&accion=' + accion
    }).then(() => {
        localStorage.setItem('recien agregado', true)
        localStorage.setItem('carrito abierto', true)
        window.location.reload();
    });
}


// MENÚ MÓVIL
const DISPARADOR_MENU_MOVIL = document.getElementById('disparador-menu-movil');
const SIDEBAR_MENU_MOVIL = document.getElementById('barra-lateral-menu-movil');
const CERRAR_MENU_MOVIL = document.getElementById('cerrar-menu-movil');
const BTN_LOGIN_MOVIL = document.getElementById('btn-login-movil');






// TOGGLE MENÚ MÓVIL
if (DISPARADOR_MENU_MOVIL) {
    DISPARADOR_MENU_MOVIL.addEventListener('click', (e) => {
        e.stopPropagation();

        if (SIDEBAR_MENU_MOVIL.classList.contains('hidden')) {
            SIDEBAR_MENU_MOVIL.classList.remove('hidden');
            SIDEBAR_MENU_MOVIL.classList.add('flex');
        } else {
            SIDEBAR_MENU_MOVIL.classList.remove('flex');
            SIDEBAR_MENU_MOVIL.classList.add('hidden');
        }
    });
}

if (CERRAR_MENU_MOVIL) {
    CERRAR_MENU_MOVIL.addEventListener('click', () => {
        SIDEBAR_MENU_MOVIL.classList.remove('flex');
        SIDEBAR_MENU_MOVIL.classList.add('hidden');
    });
}

if (BTN_LOGIN_MOVIL) {
    BTN_LOGIN_MOVIL.addEventListener('click', () => {
        // Cerrar menú móvil
        SIDEBAR_MENU_MOVIL.classList.remove('flex');
        SIDEBAR_MENU_MOVIL.classList.add('hidden');

        // Abrir login (esto también manejará el overlay y cerrará el carrito si estuviera abierto)
        abrirCerrarLogin();
    });
}


//FILTRAR PRODUCTOS MOVIL
const FILTRAR_PRODUCTOS_MOVIL = document.getElementById('filtrosProductosMovil');
const BARRA_FILTRAR_PRODUCTOS_MOVIL = document.getElementById('barra-lateral-filtros-productos-movil');

if (FILTRAR_PRODUCTOS_MOVIL) {
    FILTRAR_PRODUCTOS_MOVIL.addEventListener('click', (e) => {
        e.stopPropagation();

        if (BARRA_FILTRAR_PRODUCTOS_MOVIL.classList.contains('hidden')) {
            BARRA_FILTRAR_PRODUCTOS_MOVIL.classList.remove('hidden');
            BARRA_FILTRAR_PRODUCTOS_MOVIL.classList.add('block');
        } else {
            BARRA_FILTRAR_PRODUCTOS_MOVIL.classList.remove('block');
            BARRA_FILTRAR_PRODUCTOS_MOVIL.classList.add('hidden');
        }
    });
}
