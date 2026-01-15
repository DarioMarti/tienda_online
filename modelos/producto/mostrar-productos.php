<?php

require_once '../../config/conexionDB.php';

function mostrarProductos()
{

    try {

        $conn = conectar();

        $sentencia = $conn->prepare('SELECT * FROM productos');
        $sentencia->execute();

    } catch (PDOException $error) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los productos',
            'tipo' => 'producto'
        ];
    }

    return $sentencia->fetchAll(PDO::FETCH_ASSOC);

}

?>