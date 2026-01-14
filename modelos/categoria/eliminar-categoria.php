<?php

require_once '../../config/conexionDB.php';

$id_categoria = $_POST['id_categoria'];

try {
    $conn = conectar();
    $sentencia = $conn->prepare('UPDATE categorias SET activa = 0 WHERE id = ?');
    $sentencia->execute([$id_categoria]);
    echo json_encode([
        'estado' => 'success',
        'mensaje' => 'Categoria eliminada correctamente'
    ]);
} catch (PDOException $err) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Error al eliminar la categoria'
    ]);
}

?>