<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $titulo ?? "Aetheria" ?>
    </title>
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
    <div class=" top-0 w-full bg-fashion-black text-white text-[10px] py-2 text-center uppercase font-medium z-50 transition-transform duration-300 font-general tracking-widest"
        id="barra-superior">
        Envíos globales gratuitos en pedidos superiores a 300€
    </div>

    <!-- HEADER -->
    <header class=" top-0 w-full z-[60] py-6 px-6 lg:px-12 transition-all duration-300 z-50 bg-white">
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
                        class="absolute bg-fashion-accent text-white font-bold flex items-center justify-center rounded-full z-20 hidden  w-[13px] h-[13px] text-[8px] top-[-3px] right-[-3px] leading-none p-0 m-0 pointer-events-none">0</span>
                </div>
            </div>
        </div>
    </header>

    <!-- OVERLAY -->
    <div id="capa-superpuesta"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[45] hidden transition-opacity duration-300"></div>


    <!-- LOGIN BARRA LATERAL -->
    <div id="barra-lateral-login" class="barra-lateral barra-cerrada">
        <div class="flex justify-between items-center mb-10">
            <h2 class="editorial-font text-3xl font-semibold">Iniciar Sesión</h2>
            <button id="cerrar-login" class="text-gray-400 hover:text-fashion-black transition-colors">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>

        <!-- FORMULARIO LOGIN -->
        <form class="space-y-6 flex-1" method="POST" action="../../modelos/usuarios/crear-usuario.php">
            <div class="space-y-2">
                <label class="text-xs uppercase tracking-widest font-semibold text-gray-500 mb-4">Correo
                    Electronico</label>
                <input
                    class="w-full  py-2 text-fashion-black focus:outline-none focus:border-fashion-black transition-colors bg-transparent"
                    type="email" placeholder="tu@email.com" name="email" id="email">
            </div>
            <div class="space-y-2">
                <label class="text-xs uppercase tracking-widest font-semibold text-gray-500">Contraseña</label>
                <input type="password"
                    class="w-full py-2 text-fashion-black focus:outline-none focus:border-fashion-black transition-colors bg-transparent "
                    id="campo-pass" name="password" placeholder="••••••••">
            </div>
            <div class="flex justify-between items-center text-xs text-gray-500 pt-2 formulario-checkbox"
                id="formulario-checkbox">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" class="rounded border-gray-300 text-fashion-black focus:ring-fashion-black ">
                    <span>Recordarme</span>
                </label>
                <a href="#" class="hover:text-fashion-black underline underline-offset-4">¿Olvidaste tu
                    contraseña?</a>
            </div>
            <button type="submit" class=" bton  w-full py-4  mt-8 tracking-[0.25em]">
                Iniciar Sesión</button>
        </form>

        <!-- REGISTRARSE -->
        <div class="border-t border-gray-100 pt-8 text-center">
            <p class="text-sm text-gray-500 mb-4">¿Aún no tienes cuenta?</p>
            <a href="../paginas/registro-usuario.php"
                class="inline-block border border-fashion-black text-fashion-black px-8 py-3 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-black hover:text-white transition-all duration-300">
                Crear Cuenta
            </a>
        </div>

    </div>