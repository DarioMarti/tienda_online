<?php
session_start();
require_once '../../config/conexionDB.php';

$idProducto = $_POST['id_producto'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE productos set activo = 0 where id = ?');
    $sentencia->execute([$idProducto]);

    json_encode([
        'exito' => 'success',
        'mensaje' => "Se ha eliminado con exito"
    ]);

} catch (PDOException $err) {
    json_encode([
        'exito' => 'error',
        'mensaje' => "No se ha podido eliminar con exito"
    ]);
}

?>