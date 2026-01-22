<?php

function conectar()
{

    $host = "localhost";
    $basedatos = "u645095293_tienda";
    $usuario = "u645095293_admin";
    $password = "soniaMequinenza-12-5-";


    try {
        $conn = new PDO("mysql:host=$host; dbname=$basedatos", $usuario, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;

    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>