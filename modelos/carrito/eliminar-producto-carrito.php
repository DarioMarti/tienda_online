<?php

header('Content-Type: application/json');
session_start();
try {
    //Comprobaciones
    if (!isset($_POST['id_producto'])) {
        echo json_encode([
            'estado' => false,
            'mensaje' => 'ID de producto no recibido'
        ]);
        exit;
    }

    $id_producto = $_POST['id_producto'];

    if (!isset($_SESSION['carrito']['productos'], $_SESSION['carrito']['cantidad'])) {
        echo json_encode([
            'estado' => false,
            'mensaje' => 'El carrito está vacío'
        ]);
        exit;
    }

    //Encontrar producto en carrito
    $indice_encontrado = -1;
    foreach ($_SESSION['carrito']['productos'] as $indice => $producto) {
        if ($producto['id'] == $id_producto) {
            $indice_encontrado = $indice;
            break;
        }
    }

    if ($indice_encontrado != -1) {
        $precioProducto = $_SESSION['carrito']['productos'][$indice_encontrado]['precio'];
        $cantidad = $_SESSION['carrito']['cantidad'][$indice_encontrado];
        $_SESSION['carrito']['total'] -= $precioProducto * $cantidad;

        unset($_SESSION['carrito']['productos'][$indice_encontrado]);
        unset($_SESSION['carrito']['cantidad'][$indice_encontrado]);

        //Se reindexa el array
        $_SESSION['carrito']['productos'] = array_values($_SESSION['carrito']['productos']);
        $_SESSION['carrito']['cantidad'] = array_values($_SESSION['carrito']['cantidad']);


        echo json_encode([
            'estado' => true,
            'mensaje' => 'Producto eliminado',
            'total' => count($_SESSION['carrito']['productos'])
        ]);
        $_SESSION['mensaje'] = [
            'estado' => true,
            'mensaje' => 'Producto eliminado',
            'tipo' => 'carrito'
        ];
        exit;

    } else {
        echo json_encode([
            'estado' => false,
            'mensaje' => 'Producto no encontrado en carrito',
            'total' => count($_SESSION['carrito']['productos'])
        ]);
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Producto no encontrado en carrito',
            'tipo' => 'carrito'
        ];
        exit;
    }


} catch (PDOException $e) {
    echo json_encode([
        'estado' => false,
        'mensaje' => 'Error de BD: ' . $e->getMessage(),
        'total' => count($_SESSION['carrito']['productos'])
    ]);
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error de BD: ' . $e->getMessage(),
        'tipo' => 'carrito'
    ];
}


?>