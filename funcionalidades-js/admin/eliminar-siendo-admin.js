//Elimina el producto
async function eliminarProducto(idProducto) {

    let datos = new URLSearchParams();
    datos.append('id_producto', idProducto);

    const respuesta = await fetch('../../modelos/producto/eliminar-producto.php', {
        method: 'POST',
        body: datos
    });
    window.location.reload();

}

//Elimina el usuario
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

//Elimina la categoria
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

//Elimina el pedido
async function eliminarPedido(idPedido) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_pedido', idPedido);

        const respuesta = await fetch('../../modelos/pedido/eliminar-pedido.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}
