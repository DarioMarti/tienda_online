<?php

require_once '../../config/conexionDB.php';
session_start();
$id_usuario = $_SESSION['usuario']['id'];

try {


    $sentencia = $conn->prepare('UPDATE usuarios set activo = 0 WHERE id = ?');
    $sentencia->execute([$id_usuario]);

    header('location:../../paginas/panel-administrador.php');

    echo json_encode([
        'estado' => 'success',
        'mensaje' => 'Usuario eliminado correctamente'
    ]);

} catch (PDOException $err) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Error al eliminar el usuario'
    ]);
}


?>