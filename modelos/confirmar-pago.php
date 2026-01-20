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

    // PREPARA LOS ITEMS PARA STRIPE
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


    $YOUR_DOMAIN = DOMINIO_URL;
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $items,
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . $rutaWeb . '/src/paginas/pago-exitoso.php',
        'cancel_url' => $YOUR_DOMAIN . $rutaWeb . '/src/paginas/pago-cancelado.php',
    ]);

    echo json_encode(['id' => $checkout_session->id]);

} catch (Exception $e) {
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo json_encode(['error' => 'Stripe Error: ' . $e->getMessage()]);
}
?>