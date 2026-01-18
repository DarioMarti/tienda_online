<?php
require_once '../../../config/conexionDB.php';
session_start();

$id_producto = $_POST['id'];
$nombre = $_POST['nombre'] ?? '';
$precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0;
$categoria = $_POST['categoria'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$stock = isset($_POST['stock']) ? (int) $_POST['stock'] : 0;
$descuento = isset($_POST['descuento']) ? (float) $_POST['descuento'] : 0;
$rutaActual = $_POST['ruta-actual'] ?? '';
$imagenNueva = $_FILES['imagen'];
$errores = [];

try {
    $conn = conectar();

    if (strlen($nombre) < 1)
        $errores[] = "El campo nombre no puede estar vacio";
    if ($stock < 0)
        $errores[] = "Esto no valido";
    if ($precio < 0)
        $errores[] = "Esto no valido";

    if ($_FILES['imagen']['error'] === UPLOAD_ERR_NO_FILE) {
        $sentenciaImagen = $conn->prepare('SELECT imagen FROM productos WHERE id = ?');
        $sentenciaImagen->execute([$id_producto]);
        $imagenAnterior = $sentenciaImagen->fetch(PDO::FETCH_ASSOC);

        if (!$imagenAnterior) {
            $errores[] = "Producto no encontrado";
        } else {
            $rutaImagen = $imagenAnterior['imagen'];
        }

    } else {
        //Validaciones de la imagen
        $nombreImagen = $imagenNueva['name'];
        $extensionImagen = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
        $extensionesValidas = ['jpeg', 'jpg', 'png', 'webp'];

        if (!in_array($extensionImagen, $extensionesValidas))
            $errores[] = "Imagen no permitida";

        $nombreImagenFinal = md5(time() . $nombreImagen) . "." . $extensionImagen;
        $directorioCompleto = '../../../img/productos/' . $nombreImagenFinal;

        if (move_uploaded_file($imagenNueva['tmp_name'], $directorioCompleto)) {
            $rutaImagen = 'img/productos/' . $nombreImagenFinal;
        } else {
            $errores[] = "Hubo un problema al subir el archivo";
        }
    }

    if (!empty($errores)) {
        $mensajeErrores = implode("<br>", $errores);
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => $mensajeErrores,
            'tipo' => 'producto'
        ];
        header('location:' . $rutaActual);
        exit();
    }





    $sentenciaDescuento = $conn->prepare('SELECT descuento FROM productos WHERE id = ?');
    $sentenciaDescuento->execute([$id_producto]);
    $descuentoActual = $sentenciaDescuento->fetch(PDO::FETCH_ASSOC);

    if (!$descuentoActual) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'Producto no encontrado',
            'tipo' => 'producto'
        ];
        header('location:' . $rutaActual);
        exit();
    }

    if (empty($descuento) || $descuento == "") {
        $descuento = $descuentoActual['descuento'];
    }

    $sentencia = $conn->prepare('UPDATE productos set nombre = ?, precio = ?, imagen = ?, descripcion = ?, descuento = ?, stock = ? WHERE id = ?');
    $sentencia->execute([$nombre, $precio, $rutaImagen, $descripcion, $descuento, $stock, $id_producto]);


    $_SESSION['mensaje'] = [
        'estado' => true,
        'mensaje' => 'Producto modificado con exito',
        'tipo' => 'producto'
    ];
    header('location:' . $rutaActual);
    exit;

} catch (PDOException $err) {
    $_SESSION['mensaje'] = [
        'estado' => false,
        'mensaje' => 'Error al modificar el producto',
        'tipo' => 'producto'
    ];
    header('location:' . $rutaActual);
    exit;
}



?>