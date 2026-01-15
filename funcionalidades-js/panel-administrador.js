document.addEventListener('DOMContentLoaded', () => {
    const seccionGuardada = sessionStorage.getItem('seccionActual') || 'dashboard';
    mostrarSeccion(seccionGuardada);
});

function mostrarSeccion(seccion) {

    document.querySelectorAll('.seccion-panel').forEach(seccion => {
        seccion.classList.remove('mostrarSeccion');
        seccion.classList.add('ocultarSeccion');
    })

    let seccionSeleccionada = document.getElementById('seccion-' + seccion);
    seccionSeleccionada.classList.remove('ocultarSeccion');
    seccionSeleccionada.classList.add('mostrarSeccion');
    sessionStorage.setItem('seccionActual', seccion);
}

function desactivarCuenta() {

    fetch('../modelos/sesion/cerrar-sesion-usuario.php', {
        method: 'POST',
    })


}
