<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();
require_once $rutaRaiz . '/config/conexionDB.php';

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
            'tipo' => 'usuario'
        ];
        header('location:' . $rutaWeb . '/src/paginas/perfil-usuario.php');
        exit;
    }
}

?>