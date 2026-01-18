//Barra de busqueda
let parametros = new URLSearchParams(window.location.search);
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

        parametros.set('busqueda', valor);
        window.location.href = valor ? window.location.pathname + `?${parametros.toString()}` : 'index.php';
    }
});



//Filtrar por categoría
function filtrarCategoria(categoria) {
    parametros.set('categoria', categoria);
    window.location.href = categoria ? window.location.pathname + `?${parametros.toString()}` : 'index.php';
}


//Filtrar por precio
let valor = document.getElementById('filtro-precio-deslizador').value;

document.getElementById('filtro-precio-deslizador').addEventListener('input', function () {
    document.getElementById('valor-precio-actual').textContent = this.value + '€';
    valor = this.value;
})

document.getElementById('filtrar-precio-btn').addEventListener('click', function () {

    parametros.set('precio', valor);
    window.location.href = valor ? window.location.pathname + `?${parametros.toString()}` : 'index.php';

})


//Filtrar por orden

let barraOrden = document.getElementById('ordenar-productos')

barraOrden.addEventListener('change', function () {
    let orden = barraOrden.value;
    switch (orden) {
        case 'precio_asc':
            orden = 'precio ASC';
            break;
        case 'precio_desc':
            orden = 'precio DESC';
            break;
        case 'Alfabético_asc':
            orden = 'nombre ASC';
            break;
        case 'Alfabético_desc':
            orden = 'nombre DESC';
            break;
        case 'recientes':
            orden = 'id DESC';
            break;
        default:
            orden = '';
            break;
    }

    parametros.set('orden', orden);
    window.location.href = orden ? window.location.pathname + `?${parametros.toString()}` : 'index.php';
})

//Limpiar filtros

document.getElementById('limpiar-filtros-btn').addEventListener('click', function () {
    parametros.delete('busqueda');
    parametros.delete('categoria');
    parametros.delete('precio');
    parametros.delete('orden');
    window.location.href = window.location.pathname + `?${parametros.toString()}`;
})