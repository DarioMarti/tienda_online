<?php
session_start();
require_once '../../config/conexionDB.php';
header('Content-Type: application/json');

try {
    $conn = conectar();

    $id_producto = $_POST['id_producto'];
    $rutaActual = $_POST['ruta-actual-carrito'] ?? "";

    // Validar ID
    if (!isset($_POST['id_producto'])) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'No se recibió ID de producto',
            'tipo' => 'carrito'
        ];
    }

    // Inicializar carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [
            'productos' => [],
            'cantidad' => [],
            'total' => 0
        ];
    }

    // Buscar si el producto ya existe en el carrito
    $indice_encontrado = -1;
    foreach ($_SESSION['carrito']['productos'] as $indice => $producto) {
        if ($producto['id'] == $id_producto) {
            $indice_encontrado = $indice;
            break;
        }
    }

    if ($indice_encontrado != -1) {
        $_SESSION['carrito']['cantidad'][$indice_encontrado]++;
        $_SESSION['carrito']['total'] += $producto['precio'];

        echo json_encode([
            'estado' => true,
            'mensaje' => 'Cantidad actualizada',
            'total' => count($_SESSION['carrito']['productos'])
        ]);

    } else {
        $sentencia = $conn->prepare('SELECT * FROM productos WHERE id = ?');
        $sentencia->execute([$id_producto]);
        $producto_bd = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($producto_bd) {
            $_SESSION['carrito']['productos'][] = $producto_bd;
            $_SESSION['carrito']['cantidad'][] = 1;
            $_SESSION['carrito']['total'] += $producto_bd['precio'];

            echo json_encode([
                'estado' => true,
                'mensaje' => 'Producto agregado',
                'total' => count($_SESSION['carrito']['productos'])
            ]);
            $_SESSION['mensaje'] = [
                'estado' => true,
                'mensaje' => 'Producto agregado',
                'tipo' => 'carrito'
            ];

            exit();
        } else {
            echo json_encode([
                'estado' => false,
                'mensaje' => 'Producto no encontrado en BD',
                'total' => count($_SESSION['carrito']['productos'])
            ]);
            $_SESSION['mensaje'] = [
                'estado' => false,
                'mensaje' => 'Producto no encontrado en BD',
                'tipo' => 'carrito'
            ];

            exit();
        }
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