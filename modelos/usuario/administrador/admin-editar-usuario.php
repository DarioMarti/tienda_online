<?php

require_once '../../../config/conexionDB.php';
session_start();

if (!$_SESSION['usuario']) {
    die("Error: Se debe de estar logeado");
}

$id = $_POST['id'] ?? "";
$nombre = trim($_POST['nombre'] ?? "");
$apellidos = trim($_POST['apellidos'] ?? "");
$contrasena = $_POST['contrasena'] ?? "";
$rol = $_POST['rol'] ?? "";
$activo = intval($_POST['activo']) ?? "";
$telefono = trim(strval($_POST['telefono'] ?? ""));
$direccion = trim($_POST['direccion'] ?? "");
$rutaActual = $_POST['ruta-actual'] ?? "";
$errores = [];


if ($_SESSION['usuario']['id'] == $id && $rol != 'admin') {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'No se puede cambiar el rol de tu propio usuario',
        'tipo' => 'Editar-usuarios'
    ];
    header('location:' . $rutaActual);
    exit;
}


if (strlen($contrasena) < 6)
    $errores[] = "La contraseña debe tener al menos 6 caracteres.";
if (!preg_match('/[A-Z]/', $contrasena))
    $errores[] = "La contraseña debe contener al menos una mayúscula.";
if (!preg_match('/[0-9]/', $contrasena))
    $errores[] = "La contraseña debe contener al menos un número.";

if (!empty($errores)) {
    $mensajeErrores = implode("<br>", $errores);
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => $mensajeErrores,
        'tipo' => 'Editar-usuarios'
    ];
    header('location:' . $rutaActual);
    exit();
}

//CIFRAR CONTRASEÑA
$contraseñaCifrada = password_hash($contrasena, PASSWORD_DEFAULT);

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios SET nombre = ?, apellidos= ?, password=?, rol=?, activo=?, telefono = ?, direccion =? WHERE id = ?');
    $sentencia->execute([$nombre, $apellidos, $contraseñaCifrada, $rol, $activo, $telefono, $direccion, $id]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Usuario modificado con exito',
        'tipo' => 'Editar-usuarios'
    ];
    header('location:' . $rutaActual);
    exit;

} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al modificar el usuario',
        'tipo' => 'Editar-usuarios'
    ];
    header('location:' . $rutaActual);
    exit;
}

?>