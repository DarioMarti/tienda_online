<?php

require_once '../../config/conexionDB.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $conn = conectar();

    $_SESSION['usuario'] = [
        'id' => 1,
        'nombre' => 'Juan',
        'apellido' => 'Perez',
        'email' => 'juan@gmail.com',
        'telefono' => '123456789',
        'rol' => 'admin',
        'direccion' => 'Calle 1',
        'fecha_creacion' => '2022-01-01',
        'activo' => 1
    ];


} catch (PDOException $error) {
    echo "Error: " . $error->getMessage();
}


?>