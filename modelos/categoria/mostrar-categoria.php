<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();

require_once $rutaRaiz . '/config/conexionDB.php';

function mostrarCategorias()
{

    try {

        $conn = conectar();

        $sentencia = $conn->prepare('SELECT * FROM categorias');
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $err) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar las categorias',
            'tipo' => 'categoria'
        ];
    }
}

?>