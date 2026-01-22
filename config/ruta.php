<?php
function ruta_raiz()
{
    return realpath(__DIR__ . '/../');
}
function ruta_web()
{
    if (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] === 'localhost' || str_starts_with($_SERVER['HTTP_HOST'], '127.0.0.1'))) {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/tienda-muebles';
    }
    return 'https://norderreka.es';
}
