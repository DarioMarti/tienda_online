<?php
session_start();
require_once '../../config/conexionDB.php';
require_once '../../config/seguridad.php';
restringirAccesoClientes();

$idProducto = $_POST['id_producto'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE productos set activo = 0 where id = ?');
    $sentencia->execute([$idProducto]);


} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido eliminar el producto",
        'tipo' => 'producto'
    ];
}

?>