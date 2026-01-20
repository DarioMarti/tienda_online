<?php
require_once __DIR__ . '/../../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
header('Content-Type: application/json');
session_start();
require_once $rutaRaiz . '/config/seguridad.php';
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