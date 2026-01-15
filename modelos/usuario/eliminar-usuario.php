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
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al eliminar el usuario',
        'tipo' => 'Eliminar-usuarios'
    ];
    header('location:../../src/paginas/perfil-usuario.php');
    exit;
}


?>