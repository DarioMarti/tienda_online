<?php
require_once 'mostrar-productos.php';


$barraBusqueda = $_POST['barraBusqueda'] ?? '';
echo json_encode(mostrarProductos($barraBusqueda));
?>