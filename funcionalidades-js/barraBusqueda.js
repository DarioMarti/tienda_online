const contenedorBusqueda = document.getElementById('contenedor-busqueda');
const iconoLupa = document.getElementById('disparador-busqueda');
const inputBusqueda = document.getElementById('input-busqueda');


//Mostrar y ocultar barra de búsqueda
iconoLupa.addEventListener('click', () => {
    if (contenedorBusqueda.classList.contains('hidden')) {
        contenedorBusqueda.classList.remove('hidden');
        contenedorBusqueda.classList.add('block');
    } else {
        contenedorBusqueda.classList.remove('block');
        contenedorBusqueda.classList.add('hidden');
    }
});



inputBusqueda.addEventListener('keypress', (boton) => {
    if (boton.key === 'Enter') {
        const valor = inputBusqueda.value.trim();
        window.location.href = valor ? `index.php?busqueda=${encodeURIComponent(valor)}` : 'index.php';
    }
});