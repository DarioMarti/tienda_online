<?php
require_once __DIR__ . '/stripe_config.php';

define('GASTOS_ENVIO', 0);

switch (MONEDA_STRIPE) {
    case 'eur':
        define('MONEDA', '€');
        break;
    case 'usd':
        define('MONEDA', '$');
        break;
    default:
        define('MONEDA', '€');
        break;
}

?>