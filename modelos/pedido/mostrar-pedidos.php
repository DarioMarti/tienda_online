<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';

function mostrarPedidos($id = "")
{
    try {
        $conn = conectar();


        if ($id == "") {
            $sentencia = $conn->prepare('SELECT * FROM pedidos');
            $sentencia->execute();
            $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $pedidos;
        } else {
            $sentencia = $conn->prepare('SELECT * FROM pedidos WHERE id = ?');
            $sentencia->execute([$id]);
            $pedido = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $pedido;
        }
    } catch (PDOException $err) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los pedidos',
            'tipo' => 'pedido'
        ];
    }

}

?>