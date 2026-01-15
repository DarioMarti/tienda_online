<?php

require_once '../../config/conexionDB.php';

function mostrarPedidos()
{

    $conn = conectar();

    try {
        $sentencia = $conn->prepare('SELECT * FROM pedidos');
        $sentencia->execute();
        $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $pedidos;
    } catch (PDOException $err) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los pedidos',
            'tipo' => 'pedido'
        ];
    }

}

?>