<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? "Aetheria" ?></title>
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- ICONOS -->
    <script src="https://unpkg.com/phosphor-icons"></script>
    <!-- TAILWIND CSS -->
    <link rel="stylesheet" href="../styles/output.css">
    <!-- FAVICON -->
    <link rel="icon" href="../../img/globales/Favicon_Aetheria.ico" type="image/x-icon">
    <!-- STRIPE -->
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="antialiased">
    <!-- BARRA SUPERIOR -->
    <div class="sticky top-0 w-full bg-fashion-black text-white text-[10px] py-2 text-center uppercase font-medium z-50 transition-transform duration-300 font-general tracking-widest"
        id="barra-superior">
        Envíos globales gratuitos en pedidos superiores a 300€
    </div>

    <!-- HEADER -->
    <header class="sticky top-0 w-full z-[60] py-6 px-6 lg:px-12 transition-all duration-300">
        <div class="w-full flex justify-between align-middle items-center ">

            <!-- MENÚ DE LA IZQUIERDA -->
            <nav class="hidden lg:flex space-x-8 text-xs uppercase tracking-widest font-medium">
                <a href="index.php"
                    class="hover:text-fashion-accent transition-colors <?= ($titulo ?? '') === 'Inicio - Aetheria' ? 'text-fashion-accent' : '' ?>">
                    Home
                </a>
                <a href="rebajas-page.php"
                    class="hover:text-fashion-accent transition-colors <?= ($titulo ?? '') === 'Rebajas - Aetheria' ? 'text-red-600 font-bold' : 'text-red-500' ?>">
                    Rebajas
                </a>
                <a href="sobre-nosotros-page.php"
                    class="hover:text-fashion-accent transition-colors <?= ($titulo ?? '') === 'Sobre Nosotros - Aetheria' ? 'text-fashion-accent' : '' ?>">
                    Sobre Nosotros
                </a>
                <a href="contacto-page.php"
                    class="hover:text-fashion-accent transition-colors <?= ($titulo ?? '') === 'Contacto - Aetheria' ? 'text-fashion-accent' : '' ?>">
                    Contacto
                </a>
            </nav>

            <!-- MENÚ HAMBURGUESA MÓVIL -->
            <div class="lg:hidden text-2xl cursor-pointer" id="disparador-menu-movil">
                <i class="ph ph-list"></i>
            </div>

            <!-- LOGO -->
            <a href="index.php" class="absolute left-1/2 transform -translate-x-1/2">
                <img src="../../img/globales/Logotipo_Aetheria.svg" alt="Logo Aetheria" class="h-8">
            </a>

            <!-- ICONOS DE LA DERECHA -->
            <div class="flex items-center space-x-6 text-xl">
                <!--USUARIO NO REGISTRADO-->
                <span
                    class="text-xs uppercase tracking-widest hidden md:block cursor-pointer font-medium mr-2 login font-titulos"
                    id="btn-login">
                    Login
                </span>
                <i class="ph ph-magnifying-glass cursor-pointer hover:scale-110 transition-transform search"
                    id="disparador-busqueda"></i>
                <div class="relative cursor-pointer" id="icono-carrito">
                    <i class="ph ph-handbag cesta hover:scale-110 transition-transform"></i>
                    <span id="contador-carrito"
                        class="absolute bg-fashion-accent text-white font-bold flex items-center justify-center rounded-full z-20 hidden"
                        style="width: 13px; height: 13px; font-size: 8px; top: -3px; right: -3px; line-height: 1; padding: 0; margin: 0; pointer-events: none;">
                        0
                    </span>
                </div>
            </div>
        </div>
    </header>