<?php
session_start();
require_once '../../config/conexionDB.php';
require_once '../../config/seguridad.php';
restringirAccesoClientes();

$idPedido = $_POST['id_pedido'];

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