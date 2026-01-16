function abrirCerrarModalEditarPerfil() {
    let modalEditarPerfil = document.getElementById('modal-editar-perfil');
    if (modalEditarPerfil.classList.contains('hidden')) {
        modalEditarPerfil.classList.remove('hidden');
        modalEditarPerfil.classList.add('block');
    } else {
        modalEditarPerfil.classList.remove('block');
        modalEditarPerfil.classList.add('hidden');
    }
}

function abrirCerrarModalCambiarContrasena() {
    let modalCambiarContrasena = document.getElementById('modal-cambiar-contrasena');
    if (modalCambiarContrasena.classList.contains('hidden')) {
        modalCambiarContrasena.classList.remove('hidden');
        modalCambiarContrasena.classList.add('block');
    } else {
        modalCambiarContrasena.classList.remove('block');
        modalCambiarContrasena.classList.add('hidden');
    }
}

function cerrarModalResultado() {
    let modalResultadoContraseña = document.querySelector('.resultado-modal');

    modalResultadoContraseña.classList.remove('block');
    modalResultadoContraseña.classList.add('hidden');

    fetch('../../modelos/usuario/cerrar-sesion-mensajes.php');

}

function abrirModalEliminarCuenta() {
    let modalEliminarCuenta = document.getElementById('eliminar-cuenta-modal');
    if (modalEliminarCuenta.classList.contains('hidden')) {
        modalEliminarCuenta.classList.remove('hidden');
        modalEliminarCuenta.classList.add('block');
    } else {
        modalEliminarCuenta.classList.remove('block');
        modalEliminarCuenta.classList.add('hidden');
    }
}

//Modal para crear o modificar un usuario
function abrirCerrarModalCrearUsuario(accion, nombre = "", apellido = "", email = "", rol = "cliente", telefono = "", direccion = "", activo = "", id = "") {
    let modalUsuario = document.getElementById('modal-usuario');
    let formUsuario = document.getElementById('form-usuario');
    let tituloModalUsuario = document.getElementById('titulo-modal-usuario');
    let inputId = document.getElementById('id-usuario');

    if (modalUsuario.classList.contains('hidden')) {
        modalUsuario.classList.remove('hidden');
        modalUsuario.classList.add('block');
    } else {
        modalUsuario.classList.remove('block');
        modalUsuario.classList.add('hidden');
    }

    if (accion == 'crear') {
        formUsuario.action = '../../modelos/usuario/crear-usuario.php';

        tituloModalUsuario.textContent = 'Nuevo Usuario';
        // Limpiar campos
        document.getElementById('nombre-usuario').value = '';
        document.getElementById('apellidos-usuario').value = '';
        document.getElementById('email-usuario').value = '';
        document.getElementById('password-usuario').value = '';
        document.getElementById('rol-usuario').value = 'cliente';
        document.getElementById('email-usuario').classList.remove('bg-gray-200', 'cursor-not-allowed');
        document.getElementById('email-usuario').removeAttribute('disabled');

        inputId.value = ''; // Limpiar ID

        document.getElementById('seccion-datos-usuario-editar').classList.remove('block');
        document.getElementById('seccion-datos-usuario-editar').classList.add('hidden');

    } else if (accion == 'editar') {
        formUsuario.action = '../../modelos/usuario/administrador/admin-editar-usuario.php';

        tituloModalUsuario.textContent = 'Editar Usuario';

        inputId.value = id; // Asignar ID

        document.getElementById('nombre-usuario').value = nombre;
        document.getElementById('apellidos-usuario').value = apellido;
        document.getElementById('email-usuario').value = email;
        document.getElementById('rol-usuario').value = rol;
        document.getElementById('telefono-usuario').value = telefono;
        document.getElementById('direccion-usuario').value = direccion;
        document.getElementById('email-usuario').setAttribute('disabled', 'disabled');
        document.getElementById('email-usuario').classList.add('bg-gray-200', 'cursor-not-allowed');
        document.getElementById('activo-usuario').value = String(activo);

        document.getElementById('seccion-datos-usuario-editar').classList.remove('hidden');
        document.getElementById('seccion-datos-usuario-editar').classList.add('block');

    }
}


//Abrir y cerrar el modal de crear producto
function abrirCerrarModalCrearProducto(accion, nombre = "", descripcion = "", precio = "", stock = "", imagen = "", descuento = "", categoria = "", id = "", categoria_id = "") {
    let modalProducto = document.getElementById('modal-producto');
    let formProducto = document.getElementById('formulario-producto');
    let tituloModalProducto = document.getElementById('titulo-modal-producto');
    let inputId = document.getElementById('id-producto');
    let imagenProducto = document.getElementById('imagen-producto');
    const previsualizacion = document.getElementById('previsualizacion-imagen');
    const placeholder = document.getElementById('placeholder-subida');

    if (modalProducto.classList.contains('hidden')) {
        modalProducto.classList.remove('hidden');
        modalProducto.classList.add('block');
    } else {
        modalProducto.classList.remove('block');
        modalProducto.classList.add('hidden');
    }

    //Permite seleccionar la imagen
    document.getElementById('zona-drop').addEventListener('click', function () {
        imagenProducto.click();
    });
    //Previsualiza la imagen
    imagenProducto.addEventListener('change', function (e) {
        if (e.target.files && e.target.files[0]) {
            previsualizacion.src = URL.createObjectURL(e.target.files[0]);
            previsualizacion.classList.remove('hidden');
            //Oculta el placeholder
            placeholder.classList.add('hidden');
        }
    });

    if (accion == 'crear') {
        formProducto.action = '../../modelos/producto/crear-producto.php';
        tituloModalProducto.textContent = 'Nuevo Producto';
        inputId.value = '';

        document.getElementById('nombre-producto').value = '';
        document.getElementById('descripcion-producto').value = '';
        document.getElementById('precio-producto').value = '';
        document.getElementById('stock-producto').value = '';
        document.getElementById('imagen-producto').value = '';
        document.getElementById('descuento-producto').value = '';
        document.getElementById('categoria-producto').value = '';
        previsualizacion.src = '';
        previsualizacion.classList.add('hidden');
        placeholder.classList.remove('hidden');
        placeholder.classList.add('block');

    } else if (accion == 'editar') {
        formProducto.action = '../../modelos/usuario/administrador/admin-editar-producto.php';
        tituloModalProducto.textContent = 'Editar Producto';
        inputId.value = id;

        document.getElementById('nombre-producto').value = nombre;
        document.getElementById('descripcion-producto').value = descripcion;
        document.getElementById('precio-producto').value = precio;
        document.getElementById('stock-producto').value = stock;
        document.getElementById('descuento-producto').value = descuento;
        document.getElementById('categoria-producto').value = categoria_id;
        imagenProducto.removeAttribute('required');
        previsualizacion.src = '../../' + imagen;
        previsualizacion.classList.remove('hidden');
        placeholder.classList.remove('block');
        placeholder.classList.add('hidden');
    }
}


//Abrir y cerrar el modal de crear categoria
function abrirCerrarModalCrearCategoria(accion, nombre = "", descripcion = "", categoria_padre_id = "", id = "") {
    let modalCategoria = document.getElementById('modal-categoria');
    let formCategoria = document.getElementById('formulario-categoria');
    let tituloModalCategoria = document.getElementById('titulo-modal-categoria');
    let inputId = document.getElementById('id-categoria');

    if (modalCategoria.classList.contains('hidden')) {
        modalCategoria.classList.remove('hidden');
        modalCategoria.classList.add('block');
    } else {
        modalCategoria.classList.remove('block');
        modalCategoria.classList.add('hidden');
    }

    if (accion == 'crear') {
        formCategoria.action = '../../modelos/categoria/crear-categoria.php';
        tituloModalCategoria.textContent = 'Nueva Categoria';
        inputId.value = '';

        document.getElementById('nombre-categoria').value = '';
        document.getElementById('descripcion-categoria').value = '';
        document.getElementById('id-padre-categoria').value = '';

    } else if (accion == 'editar') {
        formCategoria.action = '../../modelos/usuario/administrador/admin-editar-categoria.php';
        tituloModalCategoria.textContent = 'Editar Categoria';
        inputId.value = id;

        document.getElementById('nombre-categoria').value = nombre;
        document.getElementById('descripcion-categoria').value = descripcion;
        document.getElementById('id-padre-categoria').value = categoria_padre_id;
    }
}


//Abrir y cerrar el modal de crear y editar pedido
function abrirCerrarModalCrearPedido(boton = null, accion, email = "", coste = "", nombre = "", direccion = "", ciudad = "", provincia = "", estado = "", id = "") {
    let modalPedido = document.getElementById('modal-pedido');
    let formPedido = document.getElementById('formulario-pedido');
    let tituloModalPedido = document.getElementById('titulo-modal-pedido');
    let inputId = document.getElementById('id-formulario-pedido');
    let bloqueProductos = document.getElementById('constructor-items-pedido');
    let costeTotal = document.getElementById('coste-total-pedido');
    costeTotal.value = "0";

    //Toma los productos cuando se edita un pedido
    let productos = [];
    if (boton && boton.dataset && boton.dataset.productos) {
        productos = JSON.parse(boton.dataset.productos);
    }

    if (modalPedido.classList.contains('hidden')) {
        modalPedido.classList.remove('hidden');
        modalPedido.classList.add('block');
        bloqueProductos.innerHTML = '';
    } else {
        modalPedido.classList.remove('block');
        modalPedido.classList.add('hidden');
    }


    let btnAgregar = document.getElementById('agregar-producto-pedido');
    let newBtn = btnAgregar.cloneNode(true);
    btnAgregar.parentNode.replaceChild(newBtn, btnAgregar);
    newBtn.addEventListener('click', agregarProducto);

    function agregarProducto(producto = null) {

        //Se crea los elementos
        let filaProducto = document.createElement('tr');
        let celdaProducto = document.createElement('td');
        let celdaStock = document.createElement('td');
        let celdaPrecio = document.createElement('td');
        let celdaPrecioTotal = document.createElement('td');

        let celdaInputStock = document.createElement('input');
        celdaInputStock.type = 'number';
        celdaInputStock.min = '1';
        celdaInputStock.max = '100';
        celdaInputStock.value = producto ? producto.cantidad : '1';
        celdaInputStock.name = 'stock[]';
        celdaStock.appendChild(celdaInputStock);

        // Estilos para las celdas
        const clasesCelda = ['px-4', 'py-3', 'text-sm', 'text-gray-600'];
        filaProducto.classList.add('border-b', 'border-gray-100', 'hover:bg-gray-50', 'transition-colors');
        celdaProducto.classList.add(...clasesCelda);
        celdaStock.classList.add(...clasesCelda, 'w-24');
        celdaPrecio.classList.add(...clasesCelda, 'text-right', 'font-medium', 'w-24');
        celdaPrecioTotal.classList.add(...clasesCelda, 'text-right', 'font-bold', 'text-fashion-black', 'w-24');
        celdaInputStock.classList.add('w-full', 'px-2', 'py-1', 'border', 'border-gray-300', 'rounded', 'focus:outline-none', 'focus:border-fashion-black', 'text-center');
        celdaPrecioTotal.classList.add('subtotal');

        filaProducto.appendChild(celdaProducto);
        filaProducto.appendChild(celdaStock);
        filaProducto.appendChild(celdaPrecio);
        filaProducto.appendChild(celdaPrecioTotal);


        bloqueProductos.appendChild(filaProducto);

        fetch('../../modelos/producto/api-mostrar-productos.php')
            .then(response => response.json())
            .then(data => {
                let selectProducto = document.createElement('select');
                selectProducto.classList.add('w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-lg', 'focus:outline-none', 'focus:border-fashion-black', 'bg-white', 'text-sm');
                selectProducto.name = 'productos[]';

                data.forEach(prod => {
                    let optionProducto = document.createElement('option');
                    optionProducto.value = prod.id;
                    optionProducto.textContent = prod.nombre;
                    optionProducto.dataset.precio = prod.precio;

                    // Si se pasa un producto específico, pre-seleccionarlo
                    if (producto && prod.id == producto.producto_id) {
                        optionProducto.selected = true;
                    }

                    selectProducto.appendChild(optionProducto);
                });
                celdaProducto.appendChild(selectProducto);

                celdaPrecio.textContent = parseFloat(selectProducto.options[selectProducto.selectedIndex].dataset.precio);
                celdaPrecioTotal.textContent = parseFloat(selectProducto.options[selectProducto.selectedIndex].dataset.precio);

                // Actualizar el precio total
                const actualizarSubtotal = () => {
                    let precioUnitario = parseFloat(selectProducto.options[selectProducto.selectedIndex].dataset.precio);
                    let cantidad = parseInt(celdaInputStock.value);
                    let subtotal = precioUnitario * cantidad;


                    celdaPrecio.textContent = precioUnitario.toFixed(2) + ' €';
                    celdaPrecioTotal.textContent = subtotal.toFixed(2) + ' €';
                };

                selectProducto.addEventListener('change', actualizarSubtotal);
                celdaInputStock.addEventListener('change', actualizarSubtotal);
                selectProducto.addEventListener('change', actualizarPrecio);
                celdaInputStock.addEventListener('change', actualizarPrecio);

                actualizarPrecio();
            })
            .catch(error => console.error('Error al cargar productos:', error));


    }
    //comrpueba el subtotal
    function actualizarPrecio() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(subtotal => {
            let precio = parseFloat(subtotal.textContent);
            console.log(precio);
            if (!isNaN(precio)) {
                total += precio;
            }
        });

        costeTotal.value = total.toFixed(2);
    }

    if (accion == 'crear') {
        formPedido.action = '../../modelos/pedido/crear-pedido.php';
        tituloModalPedido.textContent = 'Nuevo Pedido';
        inputId.value = '';

        document.getElementById('email-usuario-pedido').value = '';
        document.getElementById('coste-total-pedido').value = '';
        document.getElementById('nombre-destinatario-pedido').value = '';
        document.getElementById('direccion-envio-pedido').value = '';
        document.getElementById('ciudad-pedido').value = '';
        document.getElementById('provincia-pedido').value = '';
        document.getElementById('estado-pedido').value = '';

    } else if (accion == 'editar') {
        formPedido.action = '../../modelos/usuario/administrador/admin-editar-pedido.php';
        tituloModalPedido.textContent = 'Editar Pedido';
        inputId.value = id;

        document.getElementById('email-usuario-pedido').value = email;
        document.getElementById('coste-total-pedido').value = coste;
        document.getElementById('nombre-destinatario-pedido').value = nombre;
        document.getElementById('direccion-envio-pedido').value = direccion;
        document.getElementById('ciudad-pedido').value = ciudad;
        document.getElementById('provincia-pedido').value = provincia;
        document.getElementById('estado-pedido').value = estado;

        //Crear filas de productos ya creados
        if (productos && productos.length > 0) {
            productos.forEach(detalle => {
                agregarProducto(detalle);
            });
        }
    }



}
