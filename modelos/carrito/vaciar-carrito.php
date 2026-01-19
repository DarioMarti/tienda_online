<?php
function vaciarCarrito()
{
    if (isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [
            'id_usuario' => isset($_SESSION['usuario']) ? $_SESSION['usuario']['id'] : null,
            'productos' => [],
            'cantidad' => [],
            'total' => 0
        ];
    }
}
?>