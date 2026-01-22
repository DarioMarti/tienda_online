<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';


$nombre = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$email = trim($_POST['email'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';
$rol = $_POST['rol'] ?? 'cliente';
$activo = isset($_POST['activo']) ? (int) $_POST['activo'] : 1;
$telefono = trim(strval($_POST['telefono'] ?? ""));
$direccion = trim($_POST['direccion'] ?? "");
$urlActual = $_POST['ruta-actual'] ?? '';
$errores = [];

//VALIDAR DATOS RECIBIDOS

if (empty($nombre))
    $errores[] = "El campo nombre no puede estar vacio";
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    $errores[] = "Email introducido no valido";

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
        'tipo' => 'usuario'
    ];
    header('Location: ' . $rutaWeb . (strpos($urlActual, 'registro-usuario.php') !== false ? '/src/paginas/registro-usuario.php' : '/src/paginas/panel-administrador.php'));
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
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Este email ya está registrado.',
            'tipo' => 'usuario'
        ];
        header('Location: ' . $rutaWeb . (strpos($urlActual, 'registro-usuario.php') !== false ? '/src/paginas/registro-usuario.php' : '/src/paginas/panel-administrador.php'));
        exit();
    }


    $sentencia = $conn->prepare('INSERT INTO usuarios (nombre, apellidos, email, password,rol, telefono, direccion, activo, fecha_creacion) VALUES(?,?,?,?,?,?,?,?,now())');
    $sentencia->execute([$nombre, $apellidos, $email, $contraseñaCifrada, $rol, $telefono, $direccion, $activo]);


    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Usuario creado con exito',
        'tipo' => 'registro'
    ];

    if (!$_SESSION['usuario']) {
        $_SESSION['usuario'] = [
            'id' => $conn->lastInsertId(),
            'nombre' => $nombre,
            'apellido' => $apellidos,
            'email' => $email,
            'rol' => $rol,
            'activo' => $activo,
        ];
    }




    // Redirección inteligente
    if (strpos($urlActual, 'registro-usuario.php') !== false) {
        header('Location: ' . $rutaWeb . '/src/paginas/registro-exitoso.php');
    } else {
        header('Location: ' . $rutaWeb . '/src/paginas/panel-administrador.php');
    }

    exit;

} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al crear el usuario: ' . $error->getMessage(),
        'tipo' => 'registro'
    ];
    header('Location: ' . $rutaWeb . (strpos($urlActual, 'registro-usuario.php') !== false ? '/src/paginas/registro-usuario.php' : '/src/paginas/panel-administrador.php'));
    exit;
}

?>