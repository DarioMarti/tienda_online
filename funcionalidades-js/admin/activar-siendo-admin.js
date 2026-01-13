//ELIMINA EL PRODUCTO
async function activarProducto(idProducto) {

    let datos = new URLSearchParams();
    datos.append('id_producto', idProducto);

    const respuesta = await fetch('../../modelos/producto/activar-producto.php', {
        method: 'POST',
        body: datos
    });
    window.location.reload();

}

//ELIMINA EL USUARIO
async function activarUsuario(idUsuario) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_usuario', idUsuario);

        const respuesta = await fetch('../../modelos/usuario/administrador/admin-activar-usuario.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}

