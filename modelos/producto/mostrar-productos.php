<?php

require_once '../../config/conexionDB.php';

function mostrarProductos()
{

    try {

        $conn = conectar();

        $sentencia = $conn->prepare('SELECT * FROM productos');
        $sentencia->execute();

    } catch (PDOException $error) {
        json_encode([
            'error' => 'error',
            'mensaje' => 'Error al mostrar los productos'
        ]);
    }

    return $sentencia->fetchAll(PDO::FETCH_ASSOC);

}

?>