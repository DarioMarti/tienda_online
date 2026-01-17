<?php

require_once '../../config/conexionDB.php';

function mostrarProductos($barraBusqueda = '', $orden = 'nombre ASC', $categoria = '', $precio = null, $soloActivos = 1)
{

    try {

        $conn = conectar();
        //Se crea el sql para hacer la sentencia
        $sql = 'SELECT * FROM productos';

        $condiciones = [];
        $parametros = [];


        //Se agregan las clausulas WHERE
        if ($categoria != '') {
            $condiciones[] = 'categoria = :categoria';
            $parametros['categoria'] = $categoria;
        }

        if ($precio != null) {
            $condiciones[] = 'precio <= :precio';
            $parametros['precio'] = $precio;
        }

        if ($soloActivos) {
            $condiciones[] = 'activo = :activo';
            $parametros['activo'] = $soloActivos;
        }

        if ($barraBusqueda != '') {
            $condiciones[] = 'nombre LIKE :barraBusqueda';
            $parametros['barraBusqueda'] = "%" . $barraBusqueda . "%";
        }

        if ($condiciones) {
            $sql .= ' WHERE ' . implode(' AND ', $condiciones);
        }

        if ($orden) {
            $sql .= ' ORDER BY ' . $orden;
        }



        $sentencia = $conn->prepare($sql);
        $sentencia->execute($parametros);
        $productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $productos;

    } catch (PDOException $error) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los productos',
            'tipo' => 'producto'
        ];
    }



}


?>