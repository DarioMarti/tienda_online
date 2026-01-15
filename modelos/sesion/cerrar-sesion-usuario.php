<?php

session_start();

unset($_SESSION['usuario']);

header('location:../../src/paginas/index.php');
exit();

?>