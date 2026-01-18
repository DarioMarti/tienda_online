<?php

require_once '../../config/conexionDB.php';

function mostrarProductos($barraBusqueda = '', $orden = 'nombre ASC', $categoria = '', $precio = null, $soloActivos = 1, $descuentos = false)
{

    try {

        $conn = conectar();
        //Se crea el sql para hacer la sentencia
        $sql = 'SELECT * FROM productos';

        $condiciones = [];
        $parametros = [];


        //Se agregan las clausulas WHERE
        if ($categoria != '') {

            $sentenciaCategoria = $conn->prepare('SELECT *FROM categorias WHERE nombre = ? LIMIT 1');
            $sentenciaCategoria->execute([$categoria]);
            $categoriaFiltrada = $sentenciaCategoria->fetch(PDO::FETCH_ASSOC);
            $id_categoria = $categoriaFiltrada['id'];

            if ($id_categoria) {
                $sentenciaHijos = $conn->prepare('SELECT id FROM categorias WHERE categoria_padre_id = ?');
                $sentenciaHijos->execute([$id_categoria]);
                $hijos = $sentenciaHijos->fetchAll(PDO::FETCH_COLUMN);

                $todosLosIds = array_merge([$id_categoria], $hijos);
                $todosLosIds = array_map('intval', $todosLosIds);

                $listaIds = implode(',', $todosLosIds);

                $condiciones[] = "categoria_id IN ($listaIds)";
            }
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

        if ($descuentos) {
            $condiciones[] = 'descuento > 0';
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

        echo json_encode([
            'estado' => false,
            'mensaje' => 'Error al mostrar los productos'
        ]);
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los productos',
            'tipo' => 'producto'
        ];
        return [];
    }



}


?>