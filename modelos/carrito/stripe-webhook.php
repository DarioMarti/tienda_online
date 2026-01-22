<?php
require_once '../../config/conexionDB.php';

$datos = json_decode(file_get_contents('php://input'), true);

if ($datos['type'] === 'checkout.session.completed') {
    $meta = $datos['data']['object']['metadata'];
    $conn = conectar();

    // 1. Crear el pedido principal
    $conn->prepare("INSERT INTO pedidos (usuario_id, nombre_destinatario, coste_total, fecha, estado, direccion_envio, ciudad, provincia) VALUES (?, ?, ?, NOW(), 'pagado', ?, ?, ?)")
        ->execute([$meta['usuario_id'], $meta['nombre_destinatario'], $meta['total_pedido'], $meta['direccion_envio'], $meta['ciudad'], $meta['provincia']]);

    $id_pedido = $conn->lastInsertId();

    // 2. Insertar productos y restar stock
    foreach (json_decode($meta['productos_json'], true) as $producto) {
        $conn->prepare("INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)")
            ->execute([$id_pedido, $producto['id'], $producto['cantidad'], $producto['precio']]);

        $conn->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?")
            ->execute([$producto['cantidad'], $producto['id']]);
    }
}
http_response_code(200);
?>