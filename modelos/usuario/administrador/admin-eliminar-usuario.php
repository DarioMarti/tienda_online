<?php
require_once '../../../config/conexionDB.php';
header('Content-Type: application/json');
session_start();
require_once '../../../config/seguridad.php';
restringirSoloAdmin();

try {

    if (!isset($_POST['id_usuario'])) {
        echo json_encode(['exito' => false, 'mensaje' => 'No se recibió el ID']);
        exit;
    }

    $id_usuario = $_POST['id_usuario'];

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios set activo = 0 WHERE id = ?');
    $sentencia->execute([$id_usuario]);


    echo json_encode([
        'estado' => true,
        'mensaje' => 'Usuario eliminado correctamente'
    ]);

} catch (PDOException $err) {
    echo json_encode([
        'estado' => false,
        'mensaje' => 'Error al eliminar el usuario'
    ]);
}



?>