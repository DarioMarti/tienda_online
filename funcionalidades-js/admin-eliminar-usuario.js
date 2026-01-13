const btnEliminarUsuario = document.getElementById('btnEliminarUsuario');

async function eliminarUsuario(idUsuario) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_usuario', idUsuario);

        const respuesta = await fetch('../../modelos/usuario/administrador/admin-eliminar-usuario.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}

