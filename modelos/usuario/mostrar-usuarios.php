<?php

require_once "../../config/conexionDB.php";

function mostrarUsuarios()
{

    try {

        $conn = conectar();

        $sentencia = $conn->prepare('SELECT * FROM usuarios');
        $sentencia->execute();

        $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $usuarios;


    } catch (PDOException $err) {
        echo json_encode([
            'estado' => 'error',
            'mensaje' => $err->getMessage()
        ]);
    }
}

?>