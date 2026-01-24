<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();
require_once $rutaRaiz . '/config/conexionDB.php';

function mostrarUsuarios($nombreUsuario = "", $emailUsuario = "", $rolUsuario = "", $orden = "nombre ASC")
{

    try {

        $conn = conectar();


        //Filtrado
        $sql = 'SELECT * FROM usuarios';

        $condiciones = [];
        $parametros = [];

        if ($nombreUsuario != '') {
            $condiciones[] = ' nombre LIKE :barraBusqueda';
            $parametros['barraBusqueda'] = "%" . $nombreUsuario . "%";
        }

        if ($emailUsuario != '') {
            $condiciones[] = ' email LIKE :barraBusqueda';
            $parametros['barraBusqueda'] = "%" . $emailUsuario . "%";
        }

        if ($rolUsuario != '') {
            $condiciones[] = ' rol LIKE :barraBusqueda';
            $parametros['barraBusqueda'] = "%" . $rolUsuario . "%";
        }


        if ($condiciones) {
            $sql .= ' WHERE ' . implode(' OR ', $condiciones);
        }

        if ($orden) {
            $sql .= ' ORDER BY ' . $orden;
        }


        $sentencia = $conn->prepare($sql);
        $sentencia->execute($parametros);

        $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $usuarios;


    } catch (PDOException $err) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los usuarios',
            'tipo' => 'usuario'
        ];
        exit;
    }
}

?>