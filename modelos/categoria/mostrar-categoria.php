<?php

require_once '../../config/conexionDB.php';

function mostrarCategorias()
{

    try {

        $conn = conectar();

        $sentencia = $conn->prepare('SELECT * FROM categorias');
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $err) {
        echo json_encode([
            'estado' => 'error',
            'mensaje' => 'Error al eliminar el usuario'
        ]);
    }
}

?>