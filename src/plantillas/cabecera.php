<?php
require_once '../../modelos/carrito/mostrar-carrito.php';
require_once '../../config/seguridad.php';
$carrito = mostrarCarrito();
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

</head>

<body class="antialiased">
    <!-- BARRA SUPERIOR -->
    <div class=" top-0 w-full bg-fashion-black text-white text-[10px] py-2 text-center uppercase font-medium z-50 transition-transform duration-300 font-general tracking-widest"
        id="barra-superior">
        Envíos globales gratuitos en pedidos superiores a 300€
    </div>

    <!-- HEADER -->
    <header class="sticky top-0 w-full z-[60] py-6 px-6 lg:px-12 transition-all duration-300 z-50 bg-white">
        <div class="w-full flex justify-between align-middle items-center z-[50]">

            <!-- MENÚ DE LA IZQUIERDA -->
            <nav class="hidden lg:flex space-x-8 text-xs uppercase tracking-widest font-medium">
                <a href="index.php"
                    class="hover:text-fashion-accent transition-colors <?= ($titulo ?? '') === 'Inicio - Aetheria' ? 'text-fashion-accent' : '' ?>">
                    Home
                </a>
                <a href="rebajas.php"
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
            <div class="relative z-[60] flex items-center space-x-6 text-xl">

                <?php
                if (isset($_SESSION['usuario'])): ?>
                    <div class="relative group">
                        <span
                            class="text-xs uppercase tracking-widest hidden md:flex cursor-pointer font-medium mr-2 items-center gap-2">
                            <i class="ph ph-user-circle text-2xl "></i>
                            <?php echo htmlspecialchars($_SESSION['usuario']['nombre']) ?>
                        </span>
                        <div
                            class="hidden group-hover:block absolute right-0  w-48 bg-white shadow-lg rounded-lg py-2 z-50">
                            <a href="perfil-usuario.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-fashion-gray transition-colors">Mi
                                Perfil</a>
                            <a href="mis-pedidos.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-fashion-gray transition-colors">Mis
                                Pedidos</a>
                            <?php if (personalAutorizado()): ?>
                                <a href="panel-administrador.php" onclick="sessionStorage.setItem('seccionActual', 'dashboard')"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-fashion-gray transition-colors">
                                    Panel de <?= $_SESSION['usuario']['rol'] === 'admin' ? 'administrador' : 'empleado' ?>
                                </a>
                            <?php endif ?>
                            <hr class="my-2">
                            <a href="../../modelos/sesion/cerrar-sesion-usuario.php"
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-fashion-gray transition-colors">Cerrar
                                Sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <!--USUARIO NO REGISTRADO-->
                    <span class="text-xs uppercase tracking-widest hidden md:block cursor-pointer font-medium mr-2 login"
                        id="btn-login">Login</span>
                <?php endif ?>
                <i class="ph ph-magnifying-glass cursor-pointer hover:scale-110 transition-transform search"
                    id="disparador-busqueda"></i>
                <div class="relative cursor-pointer" id="icono-carrito">
                    <i class="ph ph-handbag cesta hover:scale-110 transition-transform"></i>
                    <span id="contador-carrito"
                        class="absolute bg-fashion-accent text-white font-bold flex items-center justify-center rounded-full z-20   w-[13px] h-[13px] text-[8px] top-[-3px] right-[-3px] leading-none p-0 m-0 pointer-events-none">
                        <?php
                        echo isset($_SESSION['usuario']) ? isset($_SESSION['carrito']) ? count($_SESSION['carrito']['cantidad']) : "0" : "0"; ?>
                    </span>

                </div>
            </div>
        </div>

        <!-- BARRA DE BUSQUEDA FILTRADA -->
        <div id="contenedor-busqueda"
            class="hidden absolute left-0 top-full w-full bg-white border-b border-gray-100 shadow-sm py-2 px-6 lg:px-12 z-50 transform transition-all duration-300 origin-top">
            <input type="text" id="input-busqueda" placeholder="BUSCAR PRODUCTOS O CATEGORÍAS..."
                class="w-full bg-transparent border-0 text-lg md:text-2xl editorial-font italic focus:ring-0 focus:outline-none py-4 placeholder:text-[8.5px] placeholder:uppercase placeholder:tracking-[0.2em] placeholder:font-sans placeholder:not-italic">
        </div>
        <!-- BARRA LATERAL CARRITO -->
        <div id="barra-lateral-carrito"
            class="barra-lateral !absolute top-full right-0  barra-lateral-cerrado z-[40] flex flex-col p-8 bg-white shadow-xl max-w-sm w-full">
            <div class="flex justify-between items-center mb-10">
                <h2 class="editorial-font text-3xl italic">Tu Cesta</h2>
                <button id="cerrar-carrito"
                    class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>
            <!-- CONTENIDO DINÁMICO DEL CARRITO -->
            <!-- CONTENEDOR DE ITEMS DEL CARRITO -->
            <div id="contenedor-items-carrito" class="flex-1 overflow-y-auto space-y-6 mb-8 pr-2 custom-scrollbar">

                <?php if (!empty($_SESSION['carrito']['productos'])): ?>
                    <?php foreach ($_SESSION['carrito']['productos'] as $indice => $producto): ?>
                        <span class="hidden producto-Carrito"></span>
                        <div class="flex gap-4 group relative ">
                            <div class="w-20 bg-gray-50 overflow-hidden rounded-md">
                                <img src="../../<?php echo htmlspecialchars($producto['imagen'] ?? 'ruta/por/defecto.jpg'); ?>"
                                    alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 flex flex-col justify-between py-1 pl-4">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-xs font-bold uppercase tracking-widest text-fashion-black pr-4">
                                            <?php echo htmlspecialchars($producto['nombre']); ?>
                                        </h4>
                                        <button onclick="eliminarProductoCarrito(<?= $producto['id'] ?>)"
                                            class="text-gray-300 hover:text-red-500 transition-colors cursor-pointer">
                                            <i class="ph ph-trash text-sm"></i>
                                        </button>
                                    </div>
                                    <p class="text-[10px] text-gray-400 uppercase">
                                        Cantidad: <?php echo $_SESSION['carrito']['cantidad'][$indice]; ?>
                                    </p>
                                </div>
                                <p class="text-xs font-medium"><?php echo number_format($producto['precio'], 2); ?> €</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-sm text-gray-500 text-center py-10">Tu cesta está vacía</p>
                <?php endif; ?>

                <!-- FOOTER DEL CARRITO -->
                <div class="border-t border-gray-100 pt-8 mt-auto">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-xs uppercase tracking-[0.2em] font-bold text-gray-400">Subtotal</span>
                        <span id="subtotal-carrito"
                            class="text-lg font-bold"><?php echo $_SESSION['carrito']['total'] ?></span>
                    </div>
                    <?php
                    $cart_empty = !isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0;
                    $checkout_url = isset($_SESSION['usuario']) ? '../paginas/checkout.php' : '../paginas/registro-usuario-page.php';
                    ?>
                    <a href="<?= $checkout_url ?>" id="btn-finalizar-compra"
                        class="block w-full py-4 text-center text-xs uppercase tracking-[0.25em] font-semibold transition-colors rounded-lg <?= $cart_empty ? 'bg-gray-200 text-gray-400 cursor-not-allowed pointer-events-none' : 'bg-fashion-black text-white hover:bg-fashion-accent' ?>">
                        Finalizar Compra
                    </a>
                    <button id="continuar-comprando" onclick="abrirCerrarCarrito()"
                        class="w-full text-center mt-4 text-[10px] uppercase tracking-widest text-gray-400 hover:text-black transition-colors cursor-pointer">
                        Continuar Comprando
                    </button>
                </div>
            </div>
        </div>

        <!-- LOGIN BARRA LATERAL -->
        <div id="barra-lateral-login" class=" !absolute top-full barra-lateral barra-lateral-cerrado z-10 " <?php if (isset($_SESSION['mensaje']) && $_SESSION['mensaje']['tipo'] === 'login' && $_SESSION['mensaje']['estado'] === false)
            echo 'data-comprobar-error="true"'; ?>>
            <div class="flex justify-between items-center mb-10">
                <h2 class="editorial-font text-3xl font-semibold">Iniciar Sesión</h2>
                <button id="btn-cerrar-login"
                    class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                    <i class="ph ph-x text-2xl"></i>
                </button>
            </div>

            <!-- FORMULARIO LOGIN -->
            <form class="space-y-6 flex-1" method="POST" action="../../modelos/sesion/sesion-usuario.php">
                <input type="hidden" name="ruta-actual-login" value="<?= $_SERVER['REQUEST_URI'] ?>">
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
                        <input type="checkbox"
                            class="rounded border-gray-300 text-fashion-black focus:ring-fashion-black ">
                        <span>Recordarme</span>
                    </label>

                    <a href="#" class="hover:text-fashion-black underline underline-offset-4">¿Olvidaste tu
                        contraseña?</a>
                </div>
                <?php if (isset($_SESSION['mensaje']) && $_SESSION['mensaje']['tipo'] === 'login' && $_SESSION['mensaje']['estado'] === false): ?>
                    <span class="text-red-600 text-xs mt-2 block">
                        <?= $_SESSION['mensaje']['mensaje']; ?>
                    </span>
                    <?php unset($_SESSION['mensaje']); ?>
                <?php endif; ?>

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
    </header>

    <!-- OVERLAY -->
    <div id="capa-superpuesta"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[45] hidden transition-opacity duration-300"></div>