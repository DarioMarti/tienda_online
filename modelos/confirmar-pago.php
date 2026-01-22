<?php
session_start();
require_once __DIR__ . '/../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/vendor/autoload.php';
require_once $rutaRaiz . '/config/stripe_config.php';
require_once $rutaRaiz . '/config/conexionDB.php';

header('Content-Type: application/json');

$usuario_id = $_SESSION['usuario']['id'];
$conn = conectar();

\Stripe\Stripe::setApiKey(STRIPE_CLAVE_SECRETA);


//Obtener los productos del carrito
try {

    $productosCarrito = $_SESSION['carrito']['productos'];

    // Prepara el producto para stripe
    $items = [];
    foreach ($productosCarrito as $indice => $productoCarrito) {

        $precioFinal = $productoCarrito['precio'];
        if ($productoCarrito['descuento'] > 0) {
            $precioFinal = $productoCarrito['precio'] - ($productoCarrito['precio'] * $productoCarrito['descuento'] / 100);
        }

        $items[] = [
            'price_data' => [
                'currency' => MONEDA_STRIPE,
                'product_data' => [
                    'name' => $productoCarrito['nombre'],
                ],
                'unit_amount' => (int) ($precioFinal * 100),
            ],
            'quantity' => $_SESSION['carrito']['cantidad'][$indice],
        ];
    }


    // Obtener datos del envío desde el formulario del checkout
    $nombre_destinatario = filter_input(INPUT_POST, 'nombre_destinatario');
    $direccion = filter_input(INPUT_POST, 'direccion_envio');
    $ciudad = filter_input(INPUT_POST, 'ciudad');
    $provincia = filter_input(INPUT_POST, 'provincia');
    $total_con_envio = filter_input(INPUT_POST, 'coste_total');

    // Preparar lista simplificada de productos
    $resumen_productos = [];
    foreach ($_SESSION['carrito']['productos'] as $indice => $productoCarrito) {
        $precioFinal = $productoCarrito['precio'];
        if ($productoCarrito['descuento'] > 0) {
            $precioFinal = $productoCarrito['precio'] - ($productoCarrito['precio'] * $productoCarrito['descuento'] / 100);
        }

        $resumen_productos[] = [
            'id' => $productoCarrito['id'],
            'cantidad' => $_SESSION['carrito']['cantidad'][$indice],
            'precio' => $precioFinal
        ];
    }

    $YOUR_DOMAIN = DOMINIO_URL;
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $items,
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/src/paginas/pago-exitoso.php',
        'cancel_url' => $YOUR_DOMAIN . '/src/paginas/pago-cancelado.php',
        'metadata' => [
            'usuario_id' => $usuario_id,
            'nombre_destinatario' => $nombre_destinatario,
            'direccion_envio' => $direccion,
            'ciudad' => $ciudad,
            'provincia' => $provincia,
            'productos_json' => json_encode($resumen_productos),
            'total_pedido' => $total_con_envio
        ]
    ]);

    echo json_encode(['id' => $checkout_session->id]);

} catch (Exception $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['error' => 'Stripe Error: ' . $e->getMessage()]);
}
?>