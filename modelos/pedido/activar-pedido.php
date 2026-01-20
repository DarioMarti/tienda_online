<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$idPedido = $_POST['id_pedido'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE pedidos set estado = "pendiente" where id = ?');
    $sentencia->execute([$idPedido]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => "Pedido activado con exito",
        'tipo' => 'pedido'
    ];

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido activar el pedido",
        'tipo' => 'pedido'
    ];
}

?>