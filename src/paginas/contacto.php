<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

$titulo = "Contacto";
require $rutaRaiz . '/src/plantillas/cabecera.php';
?>
<main class="w-full bg-white">
    <div class="flex flex-col lg:flex-row min-h-screen">

        <!-- IMAGEN A LA IZQUIERDA -->
        <div class="lg:w-1/2 lg:sticky lg:top-0 h-[50vh] lg:h-[calc(100vh-100px)]">
            <div class="relative w-full h-full overflow-hidden">
                <img src="<?= $rutaWeb ?>/img/imagen-contacto.webp" alt="Norden Réka Studio"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
        </div>

        <!-- INFORMACIÓN A LA DERECHA -->
        <div class="lg:w-1/2 flex flex-col">
            <div class="flex-1 px-10 lg:px-32 py-16 lg:py-24">

                <!-- CABECERA -->
                <div class="mb-16 lg:mb-20">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-gray-400 mb-4">Contáctanos</p>
                    <h1 class="editorial-font text-4xl lg:text-4xl italic text-fashion-black">Norder Rèka Studio</h1>
                </div>

                <!-- INFORMACIÓN DE CONTACTO -->
                <div class="space-y-12 mb-16">
                    <div>
                        <h3 class="text-[10px] uppercase tracking-[0.3em] font-bold text-fashion-black mb-4">Ubicación
                        </h3>
                        <p class="text-lg font-light text-gray-600 leading-relaxed">
                            Calle de la Moda, 42<br>
                            28001, Madrid, España
                        </p>
                    </div>

                    <div>
                        <h3 class="text-[10px] uppercase tracking-[0.3em] font-bold text-fashion-black mb-4">Consultas
                        </h3>
                        <ul class="space-y-3 text-lg font-light text-gray-600">
                            <li><a href="mailto:studio@nordenreka.com"
                                    class="hover:text-fashion-accent transition-colors">info@nordenreka.com</a></li>
                            <li><a href="tel:+34912345678" class="hover:text-fashion-accent transition-colors">+34 912
                                    345 678</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-[10px] uppercase tracking-[0.3em] font-bold text-fashion-black mb-4">Social</h3>
                        <ul class="flex space-x-6 text-2xl text-gray-400">
                            <li><a href="#" class="hover:text-fashion-black transition-colors"><i
                                        class="ph ph-instagram-logo"></i></a></li>
                            <li><a href="#" class="hover:text-fashion-black transition-colors"><i
                                        class="ph ph-pinterest-logo"></i></a></li>
                            <li><a href="#" class="hover:text-fashion-black transition-colors"><i
                                        class="ph ph-facebook-logo"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- FORMULARIO DE CONTACTO -->
                <div class="border-t border-gray-200 pt-12">
                    <h3 class="text-[10px] uppercase tracking-[0.3em] font-bold text-fashion-black mb-8">Envíanos un
                        mensaje</h3>

                    <form id="contact-form" class="space-y-8">
                        <div class="relative">
                            <input type="text" id="name" name="name" required placeholder=" "
                                class="peer w-full bg-transparent border-0 border-b border-gray-200 py-4 focus:ring-0 focus:border-fashion-black transition-colors placeholder-transparent">
                            <label for="name"
                                class="absolute left-0 top-4 text-xs uppercase tracking-widest text-gray-400 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:top-[-10px] peer-focus:text-xs">Nombre
                                Completo</label>
                        </div>

                        <div class="relative">
                            <input type="email" id="email" name="email" required placeholder=" "
                                class="peer w-full bg-transparent border-0 border-b border-gray-200 py-4 focus:ring-0 focus:border-fashion-black transition-colors placeholder-transparent">
                            <label for="email"
                                class="absolute left-0 top-4 text-xs uppercase tracking-widest text-gray-400 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:top-[-10px] peer-focus:text-xs">Email</label>
                        </div>

                        <div class="relative">
                            <textarea id="message" name="message" rows="4" required placeholder=" "
                                class="peer w-full bg-transparent border-0 border-b border-gray-200 py-4 focus:ring-0 focus:border-fashion-black transition-colors placeholder-transparent resize-none"></textarea>
                            <label for="message"
                                class="absolute left-0 top-4 text-xs uppercase tracking-widest text-gray-400 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-4 peer-focus:top-[-10px] peer-focus:text-xs">Mensaje</label>
                        </div>

                        <button type="submit"
                            class="w-full bg-fashion-black text-white py-5 text-[10px] uppercase tracking-[0.3em] font-bold rounded-lg hover:bg-fashion-accent transition-all duration-300 transform active:scale-95">
                            Enviar Mensaje
                        </button>

                        <div id="form-feedback" class="hidden text-center text-xs uppercase tracking-widest font-bold">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include $rutaRaiz . '/src/plantillas/footer.php';
?>