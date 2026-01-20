<?php

session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

unset($_SESSION['usuario']);

header('location:' . $rutaWeb);
exit();

?>