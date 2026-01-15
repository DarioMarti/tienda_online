<?php

require_once '../../config/conexionDB.php';
session_start();

$contrasenaActual = $_POST['actual_contrasena'] ?? "";
$contrasenaNueva = $_POST['nueva_contrasena'] ?? "";
$confirmarContrasena = $_POST['confirmar_contrasena'] ?? "";
$usuario_id = $_SESSION['usuario']['id'];

$errores = [];

//VALIDACIONES

if (empty($contrasenaActual) || empty($contrasenaNueva) || empty($confirmarContrasena)) {
    $errores[] = 'Todos los campos son obligatorios';
}

if ($confirmarContrasena !== $contrasenaNueva) {
    $errores[] = 'Las contraseñas deben de coincidir';
}

if (strlen($contrasenaNueva) < 6) {
    $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
}
if (!preg_match('/[A-Z]/', $contrasenaNueva)) {
    $errores[] = 'La contraseña debe contener al menos una mayúscula.';
}

if (!preg_match('/[0-9]/', $contrasenaNueva)) {
    $errores[] = 'La contraseña debe contener al menos un número.';
}

if (!empty($errores)) {
    $error = implode("\n", $errores);
    $_SESSION['mensaje'] = [
        'estado' => false,
        'titulo' => 'Cambio de contraseña',
        'mensaje' => $error,
        'tipo' => 'password'
    ];
    header('location:../../src/paginas/perfil-usuario.php');
    exit;
}


try {

    $conn = conectar();

    //SE SACA LA CONTRASEÑA DEL USUARIO
    $sentencia = $conn->prepare('SELECT password FROM usuarios WHERE id = ?');
    $sentencia->execute([$usuario_id]);
    $usuarioPass = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$usuarioPass) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'titulo' => 'Cambio de contraseña',
            'mensaje' => 'El usuario no existe',
            'tipo' => 'password'
        ];
        header('location:../../src/paginas/perfil-usuario.php');
        exit;
    }

    if (!password_verify($contrasenaActual, $usuarioPass['password'])) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'titulo' => 'Cambio de contraseña',
            'mensaje' => 'Contraseña introducida no valida',
            'tipo' => 'password'
        ];
        exit;
    }


    //SE ENCRIPTA LA NUEVA CONTRASEÑA Y SE ACTUALIZA EN LA BASE DE DATOS
    $contrasenaEncriptada = password_hash($contrasenaNueva, PASSWORD_DEFAULT);

    $sentenciaActualizar = $conn->prepare('UPDATE usuarios SET password = ? WHERE id = ?');
    $sentenciaActualizar->execute([$contrasenaEncriptada, $usuario_id]);


    $_SESSION['mensaje'] = [
        'estado' => true,
        'titulo' => 'Cambio de contraseña',
        'mensaje' => 'Contraseña cambiada con exito',
        'tipo' => 'password'
    ];

    header('location:../../src/paginas/perfil-usuario.php');
    exit;



} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'titulo' => 'Cambio de contraseña',
        'mensaje' => 'Error al cambiar la contraseña',
        'tipo' => 'password'
    ];
    header('location:../../src/paginas/perfil-usuario.php');
    exit;
}


?>