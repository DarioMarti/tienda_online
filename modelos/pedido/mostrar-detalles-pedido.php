<?php
session_start();
require_once '../../modelos/pedido/mostrar-pedidos.php';

function mostrarDetallesPedido($id_pedido)
{
    try {
        $conn = conectar();
        $stmt = $conn->prepare('SELECT * FROM detalles_pedido WHERE pedido_id = ?');
        $stmt->execute([$id_pedido]);
        $pedido = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $pedido;

    } catch (PDOException $e) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los detalles del pedido',
            'tipo' => 'pedido'
        ];
        exit();
    }

}

?>