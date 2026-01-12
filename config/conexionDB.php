<?php

function conectar(){

$host = "localhost";
$basedatos = "tienda_muebles";
$usuario = "root";
$password = "";


try{
$conn= new PDO("mysqli:host=$host; dbname=$basedatos", $usuario, $password);
$conn->setAttribute(PDO:ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);

return $conn;

}catch(PDOException $error){
    echo "Error: " . $error->getMessage();
}

?>