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



//Filtrar productos panel administrador
let inputBusquedaProductos = document.getElementById('busqueda-productos');
let botonFiltrarProductos = document.getElementById('botonFiltrarProductos');

botonFiltrarProductos.addEventListener('click', () => {
    const valor = inputBusquedaProductos.value.trim();

    parametros.set('busquedaProducto', valor);
    window.location.href = valor ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;

});

//Ordenar productos panel administrador

let barraOrdenProductos = document.getElementById('barraOrdenProductos')
if (barraOrdenProductos) {
    barraOrdenProductos.addEventListener('change', function () {
        let orden = barraOrdenProductos.value;
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

        parametros.set('ordenProductos', orden);
        window.location.href = orden ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;
    })
}


//Filtrar categorias panel administrador
let inputBusquedaCategorias = document.getElementById('busqueda-categorias');
let botonFiltrarCategorias = document.getElementById('botonFiltrarCategorias');

botonFiltrarCategorias.addEventListener('click', () => {
    const valor = inputBusquedaCategorias.value.trim();

    parametros.set('busquedaCategoria', valor);
    window.location.href = valor ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;

});

//Ordenar categorias panel administrador
let barraOrdenCategorias = document.getElementById('barraOrdenCategorias')
if (barraOrdenCategorias) {
    barraOrdenCategorias.addEventListener('change', function () {
        let orden = barraOrdenCategorias.value;
        switch (orden) {
            case 'Alfabético_asc':
                orden = 'nombre ASC';
                break;
            case 'Alfabético_desc':
                orden = 'nombre DESC';
                break;
            default:
                orden = '';
                break;
        }

        parametros.set('ordenCategorias', orden);
        window.location.href = orden ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;
    })
}



//Filtrar pedidos panel administrador
let inputBusquedaPedidos = document.getElementById('busqueda-pedidos');
let botonFiltrarPedidos = document.getElementById('botonFiltrarPedidos');

botonFiltrarPedidos.addEventListener('click', () => {
    const valor = inputBusquedaPedidos.value.trim();

    parametros.set('busquedaPedido', valor);
    window.location.href = valor ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;

});

//Ordenar pedidos panel administrador
let barraOrdenPedidos = document.getElementById('barraOrdenPedidos')
if (barraOrdenPedidos) {
    barraOrdenPedidos.addEventListener('change', function () {
        let orden = barraOrdenPedidos.value;
        switch (orden) {
            case 'precio_asc':
                orden = 'coste_total ASC';
                break;
            case 'precio_desc':
                orden = 'coste_total DESC';
                break;
            case 'Alfabético_asc':
                orden = 'nombre_destinatario ASC';
                break;
            case 'Alfabético_desc':
                orden = 'nombre_destinatario DESC';
                break;
            default:
                orden = '';
                break;
        }

        parametros.set('ordenPedidos', orden);
        window.location.href = orden ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;
    })
}


//Filtrar usuarios panel administrador
let inputBusquedaUsuario = document.getElementById('busqueda-usuario');
let botonFiltrarUsuario = document.getElementById('botonFiltrarUsuario');

botonFiltrarUsuario.addEventListener('click', () => {
    const valor = inputBusquedaUsuario.value.trim();

    parametros.set('busquedaUsuario', valor);
    window.location.href = valor ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;

});

//Ordenar usuarios panel administrador
let barraOrdenUsuario = document.getElementById('barraOrdenUsuario')
if (barraOrdenUsuario) {
    barraOrdenUsuario.addEventListener('change', function () {
        let orden = barraOrdenUsuario.value;
        switch (orden) {
            case 'Alfabético_asc':
                orden = 'nombre ASC';
                break;
            case 'Alfabético_desc':
                orden = 'nombre DESC';
                break;
            default:
                orden = '';
                break;
        }

        parametros.set('ordenUsuario', orden);
        window.location.href = orden ? `${RUTA_WEB}/src/paginas/panel-administrador.php?${parametros.toString()}` : `${RUTA_WEB}/src/paginas/panel-administrador.php`;
    })
}