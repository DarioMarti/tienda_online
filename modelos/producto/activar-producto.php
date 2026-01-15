<?php
session_start();
require_once '../../config/conexionDB.php';

$idProducto = $_POST['id_producto'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE productos set activo = 1 where id = ?');
    $sentencia->execute([$idProducto]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => "Se ha activado con exito",
        'tipo' => 'producto'
    ];


} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido activar con exito",
        'tipo' => 'producto'
    ];
}

?>