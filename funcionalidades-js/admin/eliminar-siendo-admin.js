//ELIMINA EL PRODUCTO
async function eliminarProducto(idProducto) {

    let datos = new URLSearchParams();
    datos.append('id_producto', idProducto);

    const respuesta = await fetch('../../modelos/producto/eliminar-producto.php', {
        method: 'POST',
        body: datos
    });
    window.location.reload();

}

//ELIMINA EL USUARIO
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

//ELIMINA EL CATEGORIA
async function eliminarCategoria(idCategoria) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_categoria', idCategoria);

        const respuesta = await fetch('../../modelos/categoria/eliminar-categoria.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}
