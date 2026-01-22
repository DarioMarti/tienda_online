<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();

require_once $rutaRaiz . '/config/conexionDB.php';
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$idPedido = filter_input(INPUT_POST, 'id_pedido', FILTER_VALIDATE_INT);

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE pedidos set estado = "cancelado" where id = ?');
    $sentencia->execute([$idPedido]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => "Se ha eliminado el pedido",
        'tipo' => 'pedido'
    ];

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido eliminar el pedido",
        'tipo' => 'pedido'
    ];
}

?>