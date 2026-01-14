
document.addEventListener('DOMContentLoaded', () => {
    mostrarSeccion('dashboard');
});


function mostrarSeccion(seccion) {

    document.querySelectorAll('.seccion-panel').forEach(seccion => {
        seccion.classList.add('ocultarSeccion');
    })

    let seccionSeleccionada = document.getElementById('seccion-' + seccion);
    seccionSeleccionada.classList.remove('ocultarSeccion');
    seccionSeleccionada.classList.add('mostrarSeccion');
}
