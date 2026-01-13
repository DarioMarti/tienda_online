<?php

session_start();

$_SESSION = [];          // Vacía variables de sesión
session_destroy();

header('location:../../../src/paginas/index.php');
exit();

?>