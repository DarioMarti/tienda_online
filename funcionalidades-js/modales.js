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
function abrirCerrarModalCrearProducto(accion, nombre = "", descripcion = "", precio = "", stock = "", imagen = "", descuento = "", categoria = "", id = "") {
    let modalProducto = document.getElementById('modal-producto');
    let formProducto = document.getElementById('formulario-producto');
    let tituloModalProducto = document.getElementById('titulo-modal-producto');
    let inputId = document.getElementById('id-producto');

    if (modalProducto.classList.contains('hidden')) {
        modalProducto.classList.remove('hidden');
        modalProducto.classList.add('block');
    } else {
        modalProducto.classList.remove('block');
        modalProducto.classList.add('hidden');
    }


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

    } else if (accion == 'editar') {
        formProducto.action = '../../modelos/producto/administrador/admin-editar-producto.php';
        tituloModalProducto.textContent = 'Editar Producto';
        inputId.value = id;

        document.getElementById('nombre-producto').value = nombre;
        document.getElementById('descripcion-producto').value = descripcion;
        document.getElementById('precio-producto').value = precio;
        document.getElementById('stock-producto').value = stock;
        document.getElementById('imagen-producto').value = imagen;
        document.getElementById('descuento-producto').value = descuento;
        document.getElementById('categoria-producto').value = categoria;
    }


}