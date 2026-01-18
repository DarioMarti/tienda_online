<?php


//Comprueba si el usuario es admin o empleado
function personalAutorizado()
{
    return isset($_SESSION['usuario']['rol']) && in_array($_SESSION['usuario']['rol'], ['admin', 'empleado']);
}
function esAdmin()
{
    return isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] === 'admin';
}
function estaLogueado()
{
    return isset($_SESSION['usuario']);
}

//Comprueba si el usuario es admin o empleado


function restringirAccesoClientes()
{
    if (!personalAutorizado()) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'No tienes acceso a esta área',
            'tipo' => 'acceso'
        ];
        header('Location:index.php');
        exit;
    }
}

function restringirAccesoVisitantes()
{

    if (!estaLogueado()) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'No tienes acceso a esta área',
            'tipo' => 'acceso'
        ];
        header('Location:index.php');
        exit;
    }
}
function restringirSoloAdmin()
{
    if (!esAdmin()) {
        $_SESSION['mensaje'] = [
            'estado' => false,
            'mensaje' => 'No tienes acceso a esta área',
            'tipo' => 'acceso'
        ];
        header('Location:index.php');
        exit;
    }
}

?>