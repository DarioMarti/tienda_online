<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$idProducto = $_POST['id_producto'];

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE productos set activo = 0 where id = ?');
    $sentencia->execute([$idProducto]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Producto eliminado correctamente',
        'tipo' => 'producto'
    ];


} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido eliminar el producto",
        'tipo' => 'producto'
    ];
}

?>