<?php
session_start();
require_once '../../config/conexionDB.php';
require_once '../../config/seguridad.php';
restringirAccesoClientes();

$id_categoria = $_POST['id_categoria'];

try {
    $conn = conectar();
    $sentencia = $conn->prepare('UPDATE categorias SET activa = 1 WHERE id = ?');
    $sentencia->execute([$id_categoria]);
    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Categoria activada correctamente',
        'tipo' => 'categoria'
    ];
} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al activar la categoria',
        'tipo' => 'categoria'
    ];
}

?>