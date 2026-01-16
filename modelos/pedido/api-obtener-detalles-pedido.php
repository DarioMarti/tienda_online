<?php
require_once 'mostrar-detalles-pedido.php';

echo json_encode(mostrarDetallesPedido($id_pedido));