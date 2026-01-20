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
}
function cerrarCarrito() {
    barraLateralCarrito.classList.remove('barra-lateral-abierto')
    barraLateralCarrito.classList.add('barra-lateral-cerrado')
}


function abrirCerrarLogin() {
    if (menuLateralLogin.classList.contains('barra-lateral-abierto')) {
        cerrarLogin()
    } else {
        cerrarCarrito()
        menuLateralLogin.classList.remove('barra-lateral-cerrado')
        menuLateralLogin.classList.add('barra-lateral-abierto')
    }
}

function abrirCerrarCarrito() {
    if (barraLateralCarrito.classList.contains('barra-lateral-abierto')) {
        cerrarCarrito()
    } else {
        cerrarLogin()
        barraLateralCarrito.classList.remove('barra-lateral-cerrado')
        barraLateralCarrito.classList.add('barra-lateral-abierto')
    }
}



//Modificar cantidad en el carrito

function editarCantidad(indice, accion) {
    urlActual = window.location.href;
    fetch(RUTA_WEB + '/modelos/carrito/editar-cantidad-producto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'indice=' + indice + '&accion=' + accion + '&url=' + urlActual
    }).then(() => {
        localStorage.setItem('recien agregado', true)
        window.location.reload();
    });
}