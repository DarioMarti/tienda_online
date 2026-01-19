<?php
session_start();

$indice = $_POST['indice'];
$accion = $_POST['accion'];
$urlActual = $_POST['url'];

try {
    if ($accion == 'restar') {
        $_SESSION['carrito']['cantidad'][$indice] -= 1;
    } else {
        $_SESSION['carrito']['cantidad'][$indice] += 1;
    }

    $subtotal = 0;
    foreach ($_SESSION['carrito']['productos'] as $index => $producto) {
        $subtotal += $producto['precio'] * $_SESSION['carrito']['cantidad'][$index];
    }

    $_SESSION['carrito']['total'] = $subtotal;

    header('location:' . $urlActual);
    exit();
} catch (Exception $e) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido modificar la cantidad del producto",
        'tipo' => 'producto'
    ];
    header('location:' . $urlActual);
    exit();
}
?>