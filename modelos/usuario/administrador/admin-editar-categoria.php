<?php

require_once '../../../config/conexionDB.php';
session_start();

$id = $_POST['id'] ?? "";
$nombre = $_POST['nombre'] ?? "";
$descripcion = $_POST['descripcion'] ?? "";
$categoria_padre_id = $_POST['categoria_padre_id'] ?? null;
$rutaActual = $_POST['ruta-actual'] ?? "";
$errores = [];

try {

    $conn = conectar();

    //Valida que el nombre no esté vacio

    if (empty($nombre))
        $errores[] = "El campo nombre no puede estar vacio";

    $comprobarCategoria = $conn->prepare('SELECT * FROM categorias WHERE id = ?');
    $comprobarCategoria->execute([$id]);

    if (!$comprobarCategoria->fetch()) {
        $errores[] = "La categoria no existe";
    }
    if ($categoria_padre_id === "") {
        $categoria_padre_id = null;
    }

    if (!empty($errores)) {
        $mensajeErrores = implode(" ", $errores);
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => $mensajeErrores,
            'tipo' => 'categoria'
        ];
        header('location:' . $rutaActual);
        exit();
    }

    $sentencia = $conn->prepare('UPDATE categorias SET nombre = ?, descripcion = ?, categoria_padre_id = ? WHERE id = ?');
    $sentencia->execute([$nombre, $descripcion, $categoria_padre_id, $id]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Categoria editada correctamente',
        'tipo' => 'categoria'
    ];
    header('location:' . $rutaActual);
    exit();



} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido editar la categoria",
        'tipo' => 'categoria'
    ];
    header('location:' . $rutaActual);
    exit();
}

?>