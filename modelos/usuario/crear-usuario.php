<?php

require '../../config/conexionDB.php';

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';
$errores = [];

//VALIDAR DATOS RECIBIDOS

if ($nombre === '')
    $errores[] = "El campo nombre no puede estar vacio";

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    $errores[] = "Email introducido no valido";

if (strlen($contrasena) < 6)
    $errores[] = "La contraseña debe tener al menos 6 caracteres.";
if (!preg_match('/[A-Z]/', $contrasena))
    $errores[] = "La contraseña debe contener al menos una mayúscula.";
if (!preg_match('/[0-9]/', $contrasena))
    $errores[] = "La contraseña debe contener al menos un número.";

if (!empty($errores)) {
    foreach ($errores as $e) {
        echo "<p style='color:red;'>$e</p>";
    }
    exit();
}

//CIFRAR CONTRASEÑA
$contraseñaCifrada = password_hash($contrasena, PASSWORD_DEFAULT);

try {
    $conn = conectar();

    // COMPROBAR SI EL EMAIL YA EXISTE
    $consultaEmail = $conn->prepare("SELECT id FROM usuarios WHERE email = ? LIMIT 1");
    $consultaEmail->execute([$email]);

    if ($consultaEmail->fetch()) {
        echo "<p style='color:red;'>Este email ya está registrado.</p>";
        exit();
    }


    $sentencia = $conn->prepare('INSERT INTO usuarios (nombre, email, password, fecha_creacion) VALUES(?,?,?,now())');
    $sentencia->execute([$nombre, $email, $contraseñaCifrada]);


    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Usuario creado con exito',
        'tipo' => 'Crear-usuarios'
    ];
    header('location:registro-exitoso.php');
    exit;

} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al crear el usuario',
        'tipo' => 'Crear-usuarios'
    ];
    header('location:registro-usuario.php');
    exit;
}

?>