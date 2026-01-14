<?php

require_once '../../../config/conexionDB.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$urlActual = $_POST['ruta-actual-login'];

try {
    $conn = conectar();

    if (isset($_SESSION['usuario'])) {
        header('location:../../../src/paginas/index.php');
        exit();
    }

    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'apellido' => $usuario['apellido'],
            'email' => $usuario['email'],
            'telefono' => $usuario['telefono'],
            'rol' => $usuario['rol'],
            'direccion' => $usuario['direccion'],
            'fecha_creacion' => $usuario['fecha_creacion'],
            'activo' => $usuario['activo']
        ];
        header('location:' . $urlActual);
        exit();
    } else {
        $_SESSION['error'] = "Email o contraseña incorrectos.";
        header('location:' . $urlActual);
        exit();
    }


} catch (PDOException $error) {
    echo json_encode([
        'estado' => 'error',
        'mensaje' => $error->getMessage()
    ]);
}


?>