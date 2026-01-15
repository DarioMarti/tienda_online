const botonLogin = document.getElementById('btn-login');
const botonCerrarLogin = document.getElementById('btn-cerrar-login');
const menuLateralLogin = document.getElementById('barra-lateral-login');


document.addEventListener('DOMContentLoaded', () => {
    const menuLateralLogin = document.getElementById('barra-lateral-login');

    if (menuLateralLogin?.dataset.comprobarError === 'true') {
        abrirLogin();
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