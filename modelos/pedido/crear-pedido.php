<?php

require_once '../../config/conexionDB.php';

$nombre_destinatario = $_POST['nombre_destinatario'] ?? '';
$coste_total = floatval($_POST['coste_total']) ?? 0;
$estado_pedido = $_POST['estado_pedido'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$ciudad = $_POST['ciudad'] ?? '';
$provincia = $_POST['provincia'] ?? '';

try {
    $conn = conectar();
    $sentencia = $conn->prepare('INSERT INTO pedidos (nombre_destinatario, coste_total, fecha, estado, direccion_envio, ciudad, provincia) VALUES (?, ?, now(), ?, ?, ?, ?)');
    $sentencia->execute([$nombre_destinatario, $coste_total, $estado_pedido, $direccion, $ciudad, $provincia]);
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
}
?>