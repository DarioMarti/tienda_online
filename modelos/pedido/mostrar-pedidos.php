<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();

require_once $rutaRaiz . '/config/conexionDB.php';

function mostrarPedidos($id = "", $nombreUsuario = "", $orden = "nombre_destinatario ASC")
{
    try {
        $conn = conectar();


        //Filtrado
        $sql = 'SELECT * FROM pedidos';


        $parametros = [];

        if ($nombreUsuario != '') {
            $sql .= ' WHERE nombre_destinatario LIKE :barraBusqueda';
            $parametros['barraBusqueda'] = "%" . $nombreUsuario . "%";
        }

        if ($orden) {
            $sql .= ' ORDER BY ' . $orden;
        }


        if ($id == "") {
            $sentencia = $conn->prepare($sql);
            $sentencia->execute($parametros);
            $pedidos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $pedidos;
        } else {
            $sentencia = $conn->prepare('SELECT * FROM pedidos WHERE id = ?');
            $sentencia->execute([$id]);
            $pedido = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $pedido;
        }
    } catch (PDOException $err) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Error al mostrar los pedidos',
            'tipo' => 'pedido'
        ];
    }

}

?>