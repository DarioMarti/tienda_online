<?php
session_start();
require_once '../../config/conexionDB.php';

$idProducto = $_POST['id_producto'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE productos set activo = 1 where id = ?');
    $sentencia->execute([$idProducto]);

    echo json_encode([
        'estado' => 'success',
        'mensaje' => "Se ha activado con exito"
    ]);

} catch (PDOException $err) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => "No se ha podido eliminar con exito"
    ]);
}

?>