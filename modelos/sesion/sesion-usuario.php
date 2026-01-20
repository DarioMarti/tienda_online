<?php
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
require_once $rutaRaiz . '/modelos/carrito/crear-carrito.php';

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$urlActual = $_POST['ruta-actual-login'];

try {
    $conn = conectar();

    //Se obtiene los datos del usuario
    $stmt = $conn->prepare('SELECT * FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario['activo'] == 0) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Email incorrecto. El usuario no existe.',
            'tipo' => 'login'
        ];
        header('location:' . $urlActual);
        exit();
    }

    //Se verifica la contraseña
    if (password_verify($password, $usuario['password'])) {

        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'apellido' => $usuario['apellidos'],
            'email' => $usuario['email'],
            'telefono' => $usuario['telefono'],
            'rol' => $usuario['rol'],
            'direccion' => $usuario['direccion'],
            'fecha_creacion' => $usuario['fecha_creacion'],
            'activo' => $usuario['activo']
        ];

        //Se limpian los mensajes de error que se hayan podido almacenar.
        unset($_SESSION['mensaje']);

        crearCarrito();

        header('location:' . $urlActual);
        exit();

    } else {

        //Se crea un mensaje para notificación de error.
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Contraseña incorrecta.',
            'tipo' => 'login'
        ];
        header('location:' . $urlActual);
        exit();
    }


} catch (PDOException $error) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al iniciar sesión',
        'tipo' => 'login'
    ];
    header('location:' . $urlActual);
    exit();
}


?>