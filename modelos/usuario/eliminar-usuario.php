<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
session_start();
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoVisitantes();



$id_usuario = $_SESSION['usuario']['id'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios set activo = 0 WHERE id = ?');
    $sentencia->execute([$id_usuario]);

    unset($_SESSION['usuario']);

    header('location:' . $rutaWeb . '/src/paginas/index.php');


} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al eliminar el usuario',
        'tipo' => 'usuario'
    ];
    header('location:' . $rutaWeb . '/src/paginas/perfil-usuario.php');
    exit;
}


?>