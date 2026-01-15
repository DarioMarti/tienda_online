<?php

require_once '../../config/conexionDB.php';

$id_categoria = $_POST['id_categoria'];

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