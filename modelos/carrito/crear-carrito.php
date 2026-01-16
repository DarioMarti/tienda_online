<?php

if (!isset($_SESSION['carrito'])) {
    try {
        $_SESSION['carrito'] = [
            'productos' => [],
            'cantidad' => [],
            'total' => 0
        ];
    } catch (Exception $e) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al crear el carrito',
            'tipo' => 'carrito'
        ];
    }
}

?>