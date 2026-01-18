<?php

function crearCarrito()
{
    if (!isset($_SESSION['carrito'])) {
        try {
            $_SESSION['carrito'] = [
                'id_usuario' => $_SESSION['usuario']['id'],
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
    } else {
        if ($_SESSION['usuario']['id'] !== $_SESSION['carrito']['id_usuario']) {
            unset($_SESSION['carrito']);
            try {
                $_SESSION['carrito'] = [
                    'id_usuario' => $_SESSION['usuario']['id'],
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
    }
}

?>