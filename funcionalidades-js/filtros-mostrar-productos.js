let parametros = new URLSearchParams(window.location.search);

//Barra de busqueda
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
        if (window.location.pathname.includes('rebajas.php')) {
            window.location.href = valor ? `rebajas.php?${parametros.toString()}` : 'rebajas.php';
        } else {
            window.location.href = valor ? `index.php?${parametros.toString()}` : 'index.php';
        }
    }
});



//Filtrar por categoría
function filtrarCategoria(categoria) {
    parametros.set('categoria', categoria);
    window.location.href = categoria ? window.location.pathname + `?${parametros.toString()}` : 'index.php';
}


//Filtrar por precio
let deslizadorPrecio = document.getElementById('filtro-precio-deslizador');

if (deslizadorPrecio) {
    let valor = deslizadorPrecio.value;
    deslizadorPrecio.addEventListener('input', function () {
        document.getElementById('valor-precio-actual').textContent = this.value + '€';
        valor = this.value;
    })

    document.getElementById('filtrar-precio-btn').addEventListener('click', function () {

        parametros.set('precio', valor);
        window.location.href = valor ? window.location.pathname + `?${parametros.toString()}` : 'index.php';

    })
}


//Filtrar por orden

let barraOrden = document.getElementById('ordenar-productos')

if (barraOrden) {
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
}

//Limpiar filtros

let btnLimpiarFiltros = document.getElementById('limpiar-filtros-btn');

if (btnLimpiarFiltros) {
    btnLimpiarFiltros.addEventListener('click', function () {
        parametros.delete('busqueda');
        parametros.delete('categoria');
        parametros.delete('precio');
        parametros.delete('orden');
        window.location.href = window.location.pathname + `?${parametros.toString()}`;
    })
}