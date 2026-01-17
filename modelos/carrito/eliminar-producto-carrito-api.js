function eliminarProductoCarrito(id_producto) {
    fetch('../../modelos/carrito/eliminar-producto-carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_producto=' + id_producto
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.total > 0) {
                localStorage.setItem('carrito abierto', true);
            } else {
                localStorage.setItem('carrito abierto', false);
            }

            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}