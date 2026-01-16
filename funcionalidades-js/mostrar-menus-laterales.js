const botonLogin = document.getElementById('btn-login');
const botonCerrarLogin = document.getElementById('btn-cerrar-login');
const menuLateralLogin = document.getElementById('barra-lateral-login');
const iconoCarrito = document.getElementById('icono-carrito');
const barraLateralCarrito = document.getElementById('barra-lateral-carrito');
const botonCerrarCarrito = document.getElementById('cerrar-carrito');


document.addEventListener('DOMContentLoaded', () => {
    const menuLateralLogin = document.getElementById('barra-lateral-login');

    if (menuLateralLogin?.dataset.comprobarError === 'true') {
        abrirCerrarLogin();
    }
});

if (botonLogin) { botonLogin.addEventListener('click', abrirCerrarLogin) }
if (botonCerrarLogin) { botonCerrarLogin.addEventListener('click', abrirCerrarLogin) }

function abrirCerrarLogin() {
    if (menuLateralLogin.classList.contains('barra-lateral-abierto')) {
        menuLateralLogin.classList.remove('barra-lateral-abierto')
        menuLateralLogin.classList.add('barra-lateral-cerrado')
    } else {
        menuLateralLogin.classList.remove('barra-lateral-cerrado')
        menuLateralLogin.classList.add('barra-lateral-abierto')
    }
}

if (iconoCarrito) { iconoCarrito.addEventListener('click', abrirCerrarCarrito) }
if (botonCerrarCarrito) { botonCerrarCarrito.addEventListener('click', abrirCerrarCarrito) }

function abrirCerrarCarrito() {
    if (barraLateralCarrito.classList.contains('barra-lateral-abierto')) {
        barraLateralCarrito.classList.remove('barra-lateral-abierto')
        barraLateralCarrito.classList.add('barra-lateral-cerrado')
    } else {
        barraLateralCarrito.classList.remove('barra-lateral-cerrado')
        barraLateralCarrito.classList.add('barra-lateral-abierto')
    }
}