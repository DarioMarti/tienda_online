<?php

require_once '../../config/conexionDB.php';
session_start();
require_once '../../config/seguridad.php';
restringirAccesoVisitantes();



$id_usuario = $_SESSION['usuario']['id'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios set activo = 0 WHERE id = ?');
    $sentencia->execute([$id_usuario]);

    unset($_SESSION['usuario']);

    header('location:../../src/paginas/index.php');


} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al eliminar el usuario',
        'tipo' => 'usuario'
    ];
    header('location:../../src/paginas/perfil-usuario.php');
    exit;
}


?>