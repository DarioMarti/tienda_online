//Activa el producto
async function activarProducto(idProducto) {

    let datos = new URLSearchParams();
    datos.append('id_producto', idProducto);

    const respuesta = await fetch('../../modelos/producto/activar-producto.php', {
        method: 'POST',
        body: datos
    });
    window.location.reload();

}

//Activa el usuario
async function activarUsuario(idUsuario) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_usuario', idUsuario);

        const respuesta = await fetch('../../modelos/usuario/activar-usuario.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}

//Activa la categoria
async function activarCategoria(idCategoria) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_categoria', idCategoria);

        const respuesta = await fetch('../../modelos/categoria/activar-categoria.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}

//Activa el pedido
async function activarPedido(idPedido) {
    try {

        const datos = new URLSearchParams();
        datos.append('id_pedido', idPedido);

        const respuesta = await fetch('../../modelos/pedido/activar-pedido.php', {
            method: 'POST',
            body: datos
        })

        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}