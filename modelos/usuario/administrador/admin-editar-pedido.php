<?php
require_once __DIR__ . '/../../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
session_start();
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$id_pedido = $_POST['id_pedido'] ?? '';
$nombre_destinatario = $_POST['nombre_destinatario'] ?? '';
$coste_total = floatval($_POST['coste_total']) ?? 0;
$email = $_POST['usuario_email'] ?? '';
$estado_pedido = $_POST['estado'] ?? '';
$direccion = $_POST['direccion_envio'] ?? '';
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

    if (!$comprobarEmail) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Email introducido no valido',
            'tipo' => 'pedido'
        ];
        header('Location: ' . $rutaActual);
        exit();
    }

    //Obtiene el stock de los productos que ya estaban en el pedido
    $stmtAgrupado = $conn->prepare('SELECT producto_id, cantidad FROM detalles_pedido WHERE pedido_id = ?');
    $stmtAgrupado->execute([$id_pedido]);
    $productosEnPedido = $stmtAgrupado->fetchAll(PDO::FETCH_ASSOC);
    $stockReservadoEnPedido = [];
    foreach ($productosEnPedido as $producto) {
        $stockReservadoEnPedido[$producto['producto_id']] = $producto['cantidad'];
    }

    //Obtiene el stock de los productos que se van a añadir
    for ($i = 0; $i < count($productos); $i++) {

        $stmtStock = $conn->prepare('SELECT stock FROM productos WHERE id = ?');
        $stmtStock->execute([$productos[$i]]);
        $stockEnAlmacen = $stmtStock->fetchColumn();

        //Comprueba si el producto ya estaba añadido en el pedido y se actualiza el stock real disponible
        $cantidadLiberada = isset($stockReservadoEnPedido[$productos[$i]]) ? $stockReservadoEnPedido[$productos[$i]] : 0;
        $totalDisponible = $stockEnAlmacen + $cantidadLiberada;

        if ($totalDisponible < $stock[$i]) {
            $_SESSION['mensaje'] = [
                'estado' => false,
                'mensaje' => 'No hay stock suficiente para el producto ID: ' . $productos[$i] . '. Disponible: ' . $totalDisponible,
                'tipo' => 'pedido'
            ];
            header('Location: ' . $rutaActual);
            exit();
        }
    }

    //Editar el pedido
    $sentenciaEditar = $conn->prepare('UPDATE pedidos SET nombre_destinatario = ?, coste_total = ?,  estado = ?, direccion_envio = ?, ciudad = ?, provincia = ? WHERE id = ?');
    $sentenciaEditar->execute([$nombre_destinatario, $coste_total, $estado_pedido, $direccion, $ciudad, $provincia, $id_pedido]);


    //Borrar los productos del pedido de detalles pedido y actualizar stock
    $restaurarStock = $conn->prepare('SELECT * FROM detalles_pedido WHERE pedido_id = ?');
    $restaurarStock->execute([$id_pedido]);
    $restaurarStock = $restaurarStock->fetchAll();

    for ($i = 0; $i < count($restaurarStock); $i++) {
        $sentenciaRestaurarStock = $conn->prepare('UPDATE productos SET stock = stock + ? WHERE id = ?');
        $sentenciaRestaurarStock->execute([$restaurarStock[$i]['cantidad'], $restaurarStock[$i]['producto_id']]);
    }

    $sentenciaBorrarProductos = $conn->prepare('DELETE FROM detalles_pedido WHERE pedido_id = ?');
    $sentenciaBorrarProductos->execute([$id_pedido]);

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
        'mensaje' => 'Pedido editado correctamente',
        'tipo' => 'pedido'
    ];
    header('Location: ' . $rutaActual);
    exit();


} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al editar el pedido',
        'tipo' => 'pedido'
    ];
    header('Location: ' . $rutaActual);
    exit();
}
?>