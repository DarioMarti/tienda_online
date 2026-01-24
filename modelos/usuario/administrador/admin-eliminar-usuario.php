<?php
require_once __DIR__ . '/../../../config/ruta.php';
$rutaRaiz = ruta_raiz();
require_once $rutaRaiz . '/config/conexionDB.php';
header('Content-Type: application/json');
session_start();
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

try {

    $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);

    if (!isset($id_usuario)) {
        echo json_encode(['exito' => false, 'mensaje' => 'No se recibió el ID']);
        exit;
    }
    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios set activo = 0 WHERE id = ?');
    $sentencia->execute([$id_usuario]);


    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Usuario eliminado correctamente',
        'tipo' => 'usuario'
    ];

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al eliminar el usuario',
        'tipo' => 'usuario'
    ];
}



?>