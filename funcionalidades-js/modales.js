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

    let modalResultadoContraseña = document.getElementById('resultado-modal');

    modalResultadoContraseña.classList.remove('block');
    modalResultadoContraseña.classList.add('hidden');

    fetch('../../modelos/usuario/cerrar-sesion-mensajes.php');

}