<?php
function mostrarCarrito()
{
    if (!isset($_SESSION['carrito']) || !isset($_SESSION['carrito']['productos'])) {
        return [];
    }

    $carrito = $_SESSION['carrito'];
    $ProductosCarrito = [];

    if (is_array($carrito['productos'])) {
        foreach ($carrito['productos'] as $producto) {
            $ProductosCarrito[] = $producto;
        }
    }

    return $ProductosCarrito;
}
?>