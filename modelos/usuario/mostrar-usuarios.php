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
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los usuarios',
            'tipo' => 'Mostrar-usuarios'
        ];
        header('location:../../src/paginas/perfil-usuario.php');
        exit;
    }
}

?>