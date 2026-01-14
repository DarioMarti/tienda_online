<?php

require_once '../../config/conexionDB.php';

$nombre = $_POST['nombre'] ?? "";
$descripcion = $_POST['descripcion' ?? ""];
$categoria_padre = $_POST['categoria_padre_id'] ?? null;
$errores = [];

//VALIDACIONES

if (empty($nombre))
    $errores[] = "El campo nombre no puede estar vacio";

//Comprobar si ya exite la categoria

$comprobarCategoria = $conn->prepare('SELECT * FROM categorias WHERE nombre = ? LIMIT 1');
$comprobarCategoria->execute([$nombre]);

if ($comprobarCategoria->fetch()) {
    $errores[] = "La categoria ya existe";
}

if (!empty($errores)) {
    throw new Exception("Los campos introducidos no son validos");
}

try {

    $conn = conectar();

    $sentencia = $conn->prepare('INSERT INTO categorias (nombre, descripcion, categoria_padre_id) VALUES(?,?,?)');
    $sentencia->execute([$nombre, $descripcion, $categoria_padre]);

} catch (PDOException $err) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => 'Error al eliminar el usuario'
    ]);
}

?>