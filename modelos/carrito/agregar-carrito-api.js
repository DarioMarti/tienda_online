function agregarCarritoAPI(id_producto) {
    fetch('../../modelos/carrito/agregar-carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_producto=' + id_producto,
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });

    actualizarContador();
    function actualizarContador() {
        let contador = document.getElementById('contador-carrito');
        contador.textContent = parseInt(contador.textContent) + 1;
    }
}