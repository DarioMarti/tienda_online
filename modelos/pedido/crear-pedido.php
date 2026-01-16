<?php

require_once '../../config/conexionDB.php';

$nombre_destinatario = $_POST['nombre_destinatario'] ?? '';
$coste_total = floatval($_POST['coste_total']) ?? 0;
$email = $_POST['usuario_email'] ?? '';
$estado_pedido = $_POST['estado_pedido'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$ciudad = $_POST['ciudad'] ?? '';
$provincia = $_POST['provincia'] ?? '';
$productos = $_POST['productos'] ?? [];
$stock = $_POST['stock'] ?? [];
$rutaActual = $_POST['ruta-actual'] ?? '';

try {
    $conn = conectar();

    //Comprobar email
    $comprobarEmail = $conn->prepare('SELECT * FROM usuarios WHERE email = ?');
    $comprobarEmail->execute([$email]);
    $comprobarEmail = $comprobarEmail->fetch();
    $id_usuario = $comprobarEmail['id'];

    if (!$comprobarEmail || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Email introducido no valido',
            'tipo' => 'pedido'
        ];
        header('Location: ' . $rutaActual);
        exit();
    }

    //Se comprueba que haya stock suficiente   
    for ($i = 0; $i < count($productos); $i++) {
        $comprobarStock = $conn->prepare('SELECT stock FROM productos WHERE id = ?');
        $comprobarStock->execute([$productos[$i]]);
        $stockProducto = $comprobarStock->fetch();
        $stockProducto = $stockProducto['stock'];

        if ($stockProducto < $stock[$i]) {
            $_SESSION['mensaje'] = [
                'estado' => false,
                'mensaje' => 'No hay stock suficiente',
                'tipo' => 'pedido'
            ];
            header('Location: ' . $rutaActual);
            exit();
        }
    }

    //Insertar pedido
    $sentenciaPedido = $conn->prepare('INSERT INTO pedidos (usuario_id, nombre_destinatario, coste_total, fecha, estado, direccion_envio, ciudad, provincia) VALUES (?, ?, ?, now(), ?, ?, ?, ?)');
    $sentenciaPedido->execute([$id_usuario, $nombre_destinatario, $coste_total, $estado_pedido, $direccion, $ciudad, $provincia]);
    $id_pedido = $conn->lastInsertId();

    //Insertar detalles de pedido
    for ($i = 0; $i < count($productos); $i++) {

        $precio = $conn->prepare('SELECT precio FROM productos WHERE id = ?');
        $precio->execute([$productos[$i]]);
        $precio = $precio->fetch();
        $precio = $precio['precio'];

        $sentenciaDetallePedido = $conn->prepare('INSERT INTO detalles_pedido (pedido_id,producto_id,cantidad, precio_unitario) VALUES (?, ?, ?, ?)');
        $sentenciaDetallePedido->execute([$id_pedido, $productos[$i], $stock[$i], $precio]);

        //Restar stock del producto
        $sentenciaRestarStock = $conn->prepare('UPDATE productos SET stock = stock - ? WHERE id = ?');
        $sentenciaRestarStock->execute([$stock[$i], $productos[$i]]);
    }

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => "Pedido creado correctamente",
        'tipo' => 'pedido'
    ];
} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al crear el pedido',
        'tipo' => 'pedido'
    ];
    header('Location: ' . $rutaActual);
    exit();
}
?>