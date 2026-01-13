<?php

require_once '../../config/conexionDB.php';

$nombre = strval($_POST['nombre'])??'';
$descripcion = strval($_POST['descripcion'])??'';
$precio = floatval($_POST['precio'])?? 0;
$categoria = $_POST['categoria']??'';
$categoria_padre = $_POST['categoria_padre']??'';
$descuento = floatval($_POST['descuento'])?? 0;
$stock = intval($_POST['stock'])?? 0;
$imagen = $_FILES['imagen'];
$rutaImagen = '';

$errores= [];

if(strlen($nombre)<1) $errores[] = "El campo nombre no puede estar vacio";
if($stock < 0) $errores[] = "Esto no valido";

//VALIDACIONES DE IMAGEN
$nombreImagen = $imagen['name'];
$extensionImagen = pathinfo($nombreImagen, PATHINFO_EXTENSION);
$extensionesValidas = ['jpeg', 'jpg', 'png', 'webp'];

if(!in_array($extensionImagen, $extensionesValidas)) $errores[]= "Imagen no permitida";

$nombreImagenFinal = md5(time().$nombreImagen.".".$extensionImagen);
$directorioCompleto = '../../img/productos/'.$nombreImagenFinal;

if(move_uploaded_file($imagen['tmp_name'],$directorioCompleto)){
    $rutaImagen = 'img/productos/'. $nombreImagenFinal;
}else{
    $errores[]="Hubo un problema al subir el archivo";
}


try{

$conn = conectar();

$sentencia = $conn->prepare('INSERT INTO productos (nombre,categoria, descripcion, precio, descuento, stock, imagen) VALUES(?,?,?,?,?,?,?)');
$sentencia->execute([$nombre,$categoria,$descripcion,$precio,$descuento,$stock,$rutaImagen]);


json_encode([
    'exito' => 'success',
    'mensaje' => "Producto subido con exito"
])

}catch(PDOException $err){
    json_encode([
        'exito' => 'error',
        'mensaje' => "Hubo un error al subir el producto"
    ])
}


?>