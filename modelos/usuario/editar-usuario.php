<?php

require_once '../../config/conexionDB.php';
session_start();

if (!$_SESSION['usuario']) {
    die("Error: Se debe de estar logeado");
}

$id = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'] ?? "";
$apellidos = $_POST['apellidos'] ?? "";
$telefono = intval($_POST['telefono'] ?? "");
$direccion = trim($_POST['direccion'] ?? "");

try {

    $conn = conectar();

    $sentencia = $conn->prepare('UPDATE usuarios SET nombre = ?, apellidos= ?, telefono = ?, direccion =? WHERE id = ?');
    $sentencia->execute([$nombre, $apellidos, $telefono, $direccion, $id]);

    header('location:../../src/paginas/perfil-usuario.php');

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Usuario modificado con exito',
        'tipo' => 'Editar-usuarios'
    ];
    header('location:../../src/paginas/panel-administrador.php');
    exit;

} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al modificar el usuario',
        'tipo' => 'Editar-usuarios'
    ];
    header('location:../../src/paginas/perfil-usuario.php');
    exit;
}

?>