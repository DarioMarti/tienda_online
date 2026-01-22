<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();

require_once $rutaRaiz . '/config/conexionDB.php';
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$idProducto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE productos set activo = 1 where id = ?');
    $sentencia->execute([$idProducto]);


    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Producto activado correctamente',
        'tipo' => 'producto'
    ];

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido activar con exito",
        'tipo' => 'producto'
    ];
}

?>