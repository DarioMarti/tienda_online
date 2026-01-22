<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();

require_once $rutaRaiz . '/config/conexionDB.php';
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);

try {
    $conn = conectar();
    $sentencia = $conn->prepare('UPDATE categorias SET activa = 0 WHERE id = ?');
    $sentencia->execute([$id_categoria]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Categoria eliminada correctamente',
        'tipo' => 'categoria'
    ];

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al eliminar la categoria',
        'tipo' => 'categoria'
    ];
}

?>