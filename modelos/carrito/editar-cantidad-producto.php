<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaWeb = ruta_web();

$indice = filter_input(INPUT_POST, 'indice', FILTER_VALIDATE_INT);
$accion = filter_input(INPUT_POST, 'accion');
$urlActual = filter_input(INPUT_POST, 'url');
try {
    if ($accion == 'restar') {
        if ($_SESSION['carrito']['cantidad'][$indice] > 1) {
            $_SESSION['carrito']['cantidad'][$indice] -= 1;
        } else {
            unset($_SESSION['carrito']['productos'][$indice]);
            unset($_SESSION['carrito']['cantidad'][$indice]);
            $_SESSION['carrito']['productos'] = array_values($_SESSION['carrito']['productos']);
            $_SESSION['carrito']['cantidad'] = array_values($_SESSION['carrito']['cantidad']);
        }
    } else {
        $_SESSION['carrito']['cantidad'][$indice] += 1;
    }

    $subtotal = 0;
    foreach ($_SESSION['carrito']['productos'] as $index => $producto) {
        $precio_final = $producto['precio'];
        if ($producto['descuento'] > 0) {
            $precio_final = $producto['precio'] - ($producto['precio'] * $producto['descuento'] / 100);
        }
        $subtotal += $precio_final * $_SESSION['carrito']['cantidad'][$index];
    }

    $_SESSION['carrito']['total'] = $subtotal;

    exit();
} catch (Exception $e) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido modificar la cantidad del producto",
        'tipo' => 'producto'
    ];
    exit();
}
?>