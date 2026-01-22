<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/src/plantillas/cabecera.php';
?>

<main class="min-h-screen bg-fashion-gray flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-xl">
        <div class="text-center">
            <h2 class="font-titulos text-4xl italic text-fashion-black mb-2">Crear Cuenta</h2>
            <p class="text-sm text-gray-500 tracking-wide">Únete a la familia Norden Réka</p>
        </div>
        <!-- FORMULARIO REGISTRO -->
        <form class="mt-8 space-y-6" action="<?= $rutaWeb ?>/modelos/usuario/crear-usuario.php" method="POST">
            <input type="hidden" name="ruta-actual" value="<?= $_SERVER['REQUEST_URI'] ?>">

            <!-- NOMBRE DE USUARIO -->
            <div class="space-y-2">
                <label for="username" class="text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Nombre
                </label>
                <input id="username" name="nombre" type="text" required
                    class="w-full px-4 py-3 bg-[#F5F5F5] focus:border-fashion-black focus:outline-none transition-colors bg-transparent text-fashion-black placeholder-gray-400"
                    placeholder="Tu nombre de usuario">
            </div>

            <!-- EMAIL -->
            <div class="space-y-2">
                <label for="email" class="text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Email
                </label>
                <input id="email" name="email" type="email" required
                    class="w-full px-4 py-3 bg-[#F5F5F5] focus:border-fashion-black focus:outline-none transition-colors bg-transparent text-fashion-black placeholder-gray-400"
                    placeholder="tu@email.com">
            </div>

            <!-- CONTRASEÑA -->
            <div class="space-y-2">
                <label for="password" class="text-xs uppercase tracking-widest font-semibold text-gray-700">
                    Contraseña
                </label>
                <input id="password" name="contrasena" type="password" required
                    class="w-full px-4 py-3 bg-[#F5F5F5] focus:border-fashion-black focus:outline-none transition-colors bg-transparent text-fashion-black placeholder-gray-400"
                    placeholder="••••••••">
            </div>

            <!-- TÉRMINOS Y CONDICIONES -->
            <div class="flex items-start space-x-3 pt-2">
                <input id="terms" name="terms" type="checkbox" required
                    class="mt-1 rounded border-gray-300 text-fashion-black focus:ring-fashion-black focus:ring-2">
                <label for="terms" class="text-xs text-gray-600 leading-relaxed">
                    Acepto los <a href="#"
                        class="text-fashion-black underline underline-offset-2 hover:text-fashion-accent transition-colors">términos
                        y condiciones</a> y la <a href="#"
                        class="text-fashion-black underline underline-offset-2 hover:text-fashion-accent transition-colors">política
                        de privacidad</a>
                </label>
            </div>
            <?php if (isset($_SESSION['mensaje']) && $_SESSION['mensaje']['tipo'] === 'registro' && $_SESSION['mensaje']['estado'] === false): ?>
                <span class="text-red-600 text-xs mt-2 block">
                    <?= $_SESSION['mensaje']['mensaje']; ?>
                </span>
            <?php endif; ?>
            <!-- BOTÓN DE REGISTRO -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-fashion-black cursor-pointer text-white py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all duration-300 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Crear Cuenta
                </button>
            </div>

            <!-- INICIAR SESIÓN -->
            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    ¿Ya tienes cuenta?
                    <span onclick="abrirCerrarLogin()"
                        class="text-fashion-black font-semibold hover:text-fashion-accent transition-colors underline underline-offset-2 cursor-pointer">
                        Inicia Sesión
                    </span>
                </p>
            </div>

        </form>
    </div>

</main>

<?php
require_once $rutaRaiz . '/src/plantillas/footer.php';
?>