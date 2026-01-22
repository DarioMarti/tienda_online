<?php
require_once 'mostrar-detalles-pedido.php';

$id_pedido = $_GET['id_pedido'] ?? "";
echo json_encode(mostrarDetallesPedido($id_pedido));