<?php

require_once '../../config/conexionDB.php';
session_start();
require_once '../../config/seguridad.php';
restringirAccesoClientes();

$nombre = $_POST['nombre'] ?? "";
$descripcion = $_POST['descripcion'] ?? "";
$categoria_padre_id = $_POST['categoria_padre_id'] ?? null;
$rutaActual = $_POST['ruta-actual'] ?? "";
$errores = [];



try {

    $conn = conectar();

    //VALIDACIONES

    if (empty($nombre))
        $errores[] = "El campo nombre no puede estar vacio";

    //Comprobar si ya exite la categoria
    $comprobarCategoria = $conn->prepare('SELECT * FROM categorias WHERE nombre = ? LIMIT 1');
    $comprobarCategoria->execute([$nombre]);

    if ($comprobarCategoria->fetch()) {
        $errores[] = "La categoria ya existe";
    }


    //Obtener categoría padre a raíz de la id recibida
    if (!empty($categoria_padre_id)) {
        $sentenciaPadre = $conn->prepare('SELECT nombre FROM categorias WHERE id = ? LIMIT 1');
        $sentenciaPadre->execute([$categoria_padre_id]);
        $categoria_padre_nombre = $sentenciaPadre->fetch(PDO::FETCH_ASSOC);

        if (!$categoria_padre_nombre) {
            $errores[] = "La categoria padre no existe";
        } else if ($categoria_padre_nombre['nombre'] == $nombre) {
            $errores[] = "La categoria y la categoria padre no pueden ser la misma";
        }
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


    // Convertir cadena vacía a NULL para que SQL no falle
    if ($categoria_padre_id === "") {
        $categoria_padre_id = null;
    }

    $sentencia = $conn->prepare('INSERT INTO categorias (nombre, descripcion, categoria_padre_id) VALUES(?,?,?)');
    $sentencia->execute([$nombre, $descripcion, $categoria_padre_id]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Categoria creada correctamente',
        'tipo' => 'categoria'
    ];

    header('location:' . $rutaActual);
    exit();

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al crear la categoria',
        'tipo' => 'categoria'
    ];
    header('location:' . $rutaActual);
    exit();
}

?>