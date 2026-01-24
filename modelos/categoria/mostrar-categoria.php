<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();

require_once $rutaRaiz . '/config/conexionDB.php';

function mostrarCategorias($nombreCat = "", $ordenCat = "nombre ASC")
{

    //Filtrado
    $sql = 'SELECT * FROM categorias';


    $parametros = [];

    if ($nombreCat != '') {
        $sql .= ' WHERE nombre LIKE :barraBusqueda';
        $parametros['barraBusqueda'] = "%" . $nombreCat . "%";
    }

    if ($ordenCat) {
        $sql .= ' ORDER BY ' . $ordenCat;
    }

    try {

        $conn = conectar();

        $sentencia = $conn->prepare($sql);
        $sentencia->execute($parametros);

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