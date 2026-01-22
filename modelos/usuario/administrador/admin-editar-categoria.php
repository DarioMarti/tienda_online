<?php
require_once __DIR__ . '/../../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/conexionDB.php';
session_start();
require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nombre = $_POST['nombre'] ?? "";
$descripcion = $_POST['descripcion'] ?? "";
$categoria_padre_id = filter_input(INPUT_POST, 'categoria_padre_id', FILTER_VALIDATE_INT);
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
    if ($categoria_padre_id === false || $categoria_padre_id === "") {
        $categoria_padre_id = null;
    }

    //Comprobar que la categoria no tenga el mismo nombre que el padre
    if (!empty($categoria_padre_id)) {
        $stmt = $conn->prepare('SELECT nombre FROM categorias WHERE id = ?');
        $stmt->execute([$categoria_padre_id]);
        $padre = $stmt->fetch();
        if ($padre) {
            if (strtolower($padre['nombre']) == strtolower($nombre)) {
                $errores[] = "La categoría no puede tener el mismo nombre que su categoría padre.";
            }
        }
    }



    if (!empty($errores)) {
        $mensajeErrores = implode(" ", $errores);
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => $mensajeErrores,
            'tipo' => 'categoria'
        ];
        header('location:' . $rutaWeb . '/src/paginas/panel-administrador.php');
        exit();
    }

    $sentencia = $conn->prepare('UPDATE categorias SET nombre = ?, descripcion = ?, categoria_padre_id = ? WHERE id = ?');
    $sentencia->execute([$nombre, $descripcion, $categoria_padre_id, $id]);

    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Categoria editada correctamente',
        'tipo' => 'categoria'
    ];
    header('location:' . $rutaWeb . '/src/paginas/panel-administrador.php');
    exit();



} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => "No se ha podido editar la categoria",
        'tipo' => 'categoria'
    ];
    header('location:' . $rutaWeb . '/src/paginas/panel-administrador.php');
    exit();
}

?>