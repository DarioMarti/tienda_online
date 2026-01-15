<?php

session_start();

unset($_SESSION['mensaje']);
header('location:../../../src/paginas/perfil-usuario.php');
exit();

?>