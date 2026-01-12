<?php
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
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- ICONOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- TAILWIND CSS -->
    <link rel="stylesheet" href="../styles/output.css">
    <!-- FAVICON -->
    <link rel="icon" href="../../img/globales/Favicon_Aetheria.ico" type="image/x-icon">
    <!-- STRIPE -->
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="antialiased">
    <!-- BARRA SUPERIOR -->
    <div class="sticky top-0 w-full bg-fashion-black text-white text-[10px] py-2 text-center uppercase font-medium z-50 transition-transform duration-300 font-family-sans tracking-widest"
        id="barra-superior">
        Envíos globales gratuitos en pedidos superiores a 300€
    </div>

    <!-- HEADER -->
    <header>
        <div class="w-full flex justify-between items-center">

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
                <i class="fa-solid fa-bars"></i>
            </div>

            <!-- LOGO -->
            <a href="index.php" class="absolute left-1/2 transform -translate-x-1/2">
                <img src="../../img/globales/Logotipo_Aetheria.svg" alt="Logo Aetheria" class="h-8">
            </a>

            <!-- ICONOS DE LA DERECHA -->
            <div class="flex items-center space-x-6 text-xl">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <!-- USUARIO REGISTRADO -->
                    <div class="relative group">
                        <span
                            class="text-xs uppercase tracking-widest hidden md:flex cursor-pointer font-medium mr-2 items-center gap-2">
                            <i class="ph ph-user-circle text-2xl"></i>
                            <span>
                                <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                            </span>
                        </span>
                        <!--SUBMENÚ DEL USUARIO REGISTRADO -->
                        <div
                            class="hidden group-hover:block absolute right-0  w-48 bg-white shadow-lg rounded-lg py-2 z-50">
                            <a href="perfil-page.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-fashion-gray transition-colors">Mi
                                Perfil</a>
                            <a href="mis-pedidos-page.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-fashion-gray transition-colors">Mis
                                Pedidos</a>

                            <?php if (esPersonalAutorizado()): ?>
                                <a href="admin-page.php"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-fashion-gray transition-colors">
                                    Panel de
                                    <?= $_SESSION['usuario']['rol'] === 'admin' ? 'administrador' : 'empleado' ?>
                                </a>
                            <?php endif; ?>
                            <hr class="my-2">

                            <a href="../modelos/usuarios/cerrar-sesion.php"
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-fashion-gray transition-colors">Cerrar
                                Sesión</a>
                        </div>
                    </div>
                <?php else: ?>

                    <!--USUARIO NO REGISTRADO-->
                    <span class="text-xs uppercase tracking-widest hidden md:block cursor-pointer font-medium mr-2 login"
                        id="btn-login">
                        Login
                    </span>
                <?php endif; ?>

                <i class="ph ph-magnifying-glass cursor-pointer hover:scale-110 transition-transform search"
                    id="disparador-busqueda"></i>
                <div class="relative cursor-pointer" id="icono-carrito">
                    <i class="ph ph-handbag cesta hover:scale-110 transition-transform"></i>
                    <?php
                    $total_carrito = 0;
                    if (isset($_SESSION['usuario'])) {
                        $conn = conectar();
                        $stmt = $conn->prepare("SELECT SUM(cantidad) as total FROM carrito WHERE usuario_id = ?");
                        $stmt->execute([$_SESSION['usuario']['id']]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $total_carrito = $result['total'] ?? 0;
                    } elseif (isset($_SESSION['carrito'])) {
                        foreach ($_SESSION['carrito'] as $item) {
                            $total_carrito += $item['cantidad'];
                        }
                    }
                    ?>
                    <span id="contador-carrito"
                        class="absolute bg-fashion-accent text-white font-bold flex items-center justify-center rounded-full z-20 <?= $total_carrito > 0 ? '' : 'hidden' ?>"
                        style="width: 13px; height: 13px; font-size: 8px; top: -3px; right: -3px; line-height: 1; padding: 0; margin: 0; pointer-events: none;">
                        <?= $total_carrito ?>
                    </span>
                </div>
            </div>
        </div>
    </header>