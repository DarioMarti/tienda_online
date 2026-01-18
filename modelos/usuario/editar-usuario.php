<?php

require_once '../../config/conexionDB.php';
session_start();
require_once '../../config/seguridad.php';
restringirAccesoVisitantes();

$id = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'] ?? "";
$apellidos = $_POST['apellidos'] ?? "";
$telefono = intval($_POST['telefono'] ?? "");
$direccion = trim($_POST['direccion'] ?? "");
$rutaActual = $_POST['ruta-actual-login'] ?? "";

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios SET nombre = ?, apellidos= ?, telefono = ?, direccion =? WHERE id = ?');
    $sentencia->execute([$nombre, $apellidos, $telefono, $direccion, $id]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Usuario modificado con exito',
        'tipo' => 'usuario'
    ];
    $_SESSION['usuario'] = [
        'id' => $_SESSION['usuario']['id'],
        'nombre' => $nombre,
        'apellido' => $apellidos,
        'email' => $_SESSION['usuario']['email'],
        'telefono' => $telefono,
        'rol' => $_SESSION['usuario']['rol'],
        'direccion' => $direccion,
        'fecha_creacion' => $_SESSION['usuario']['fecha_creacion'],
        'activo' => $_SESSION['usuario']['activo']
    ];
    header('location:' . $rutaActual);
    exit;

} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al modificar el usuario',
        'tipo' => 'usuario'
    ];
    header('location:' . $rutaActual);
    exit;
}

?>