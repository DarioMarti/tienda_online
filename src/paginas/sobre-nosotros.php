<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/src/plantillas/cabecera.php';
?>

<main class="w-full bg-white overflow-hidden">
    <!-- IMAGEN CABECERA -->
    <section class="relative w-full h-screen overflow-hidden">
        <img src="<?= $rutaWeb ?>/img/sobre-nosotros/sobre-nosotros-hero-v2.png" alt="Norden Réka taller"
            class="w-full h-full object-cover scale-105 animate-[ken-burns_20s_ease_infinite_alternative]">
        <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-6 space-y-4">
            <p class="text-[10px] uppercase tracking-[0.5em] text-white/70 animate-[fadeIn_1.5s_ease-out]">Est. 2020
                — Madrid</p>
            <h1
                class="editorial-font text-6xl md:text-9xl text-white italic leading-tight animate-[fadeIn_1.8s_ease-out]">
                Norden Réka
            </h1>
            <p
                class="text-white/80 text-sm md:text-lg font-light tracking-[0.1em] max-w-xl mx-auto animate-[fadeIn_2s_ease-out]">
                La intersección entre la elegancia radical y la artesanía atemporal.
            </p>

        </div>
    </section>

    <!-- HISTORIA DE LA MARCA-->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- TEXTO PRINCIPAL -->
            <div class="col-span-12 lg:col-span-7 space-y-12">
                <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-fashion-accent">Nuestra Manifiesto</h2>
                <p class="editorial-font text-4xl md:text-6xl italic text-fashion-black leading-[1.1]">
                    Esculpiendo el <span class="text-fashion-accent">espacio interior</span>.
                </p>
                <div class="space-y-8 max-w-2xl">
                    <p class="text-lg text-gray-800 font-light leading-relaxed">
                        Fundada en 2020, Norden Réka nace de una visión clara: crear piezas de mobiliario que
                        trasciendan las tendencias efímeras. No somos una tienda de muebles convencional; somos un
                        estudio de diseño dedicado a la perfección de la forma, la pureza de las líneas y la calidad
                        táctil de cada material.
                    </p>
                    <p class="text-lg text-gray-600 font-light leading-relaxed">
                        Cada pieza es el resultado de un diálogo íntimo entre la tradición artesanal y la innovación
                        contemporánea. Trabajamos mano a mano con maestros ebanistas y artesanos, seleccionamos
                        materiales excepcionales y dedicamos el tiempo necesario para que cada objeto sea un testimonio
                        de excelencia y un refugio de diseño en el hogar.
                    </p>
                </div>
            </div>

            <!--TEXTO FLOTANTE -->
            <div class="col-span-12 lg:col-span-5 relative mt-12 lg:mt-0">
                <div class="relative w-full aspect-[3/4] overflow-hidden rounded-sm group shadow-2xl">
                    <img src="<?= $rutaWeb ?>/img/sobre-nosotros/filosofia-muebles.png" alt="Norden Réka detalles"
                        class="w-full h-full object-cover grayscale transition-all duration-1000 group-hover:grayscale-0 group-hover:scale-110">
                </div>
                <div
                    class="mt-8 lg:absolute lg:-bottom-6 lg:-left-6 glass-card p-10 max-w-xs shadow-2xl animate-[float_6s_ease-in-out_infinite bg-white ">
                    <p class="text-xs uppercase tracking-widest text-fashion-accent mb-4">Filosofía</p>
                    <p class="editorial-font italic text-xl">"La simplicidad es la máxima sofisticación."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PILARES DE LA MARCA - TARJETAS -->
    <section class="bg-fashion-gray py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-24">
                <h2 class="text-[10px] uppercase tracking-[0.5em] font-bold text-fashion-black/40 mb-4">Nuestros Pilares
                </h2>
                <h3 class="editorial-font text-5xl italic">Valores que nos definen</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- ARTESANIA -->
                <div
                    class="bg-white/80 backdrop-blur-md p-10 hover-lift group border border-fashion-black/5 rounded-sm transition-all duration-500">
                    <div
                        class="w-12 h-12 mb-8 flex items-center justify-center border border-fashion-black/10 rounded-full group-hover:bg-fashion-accent group-hover:text-white transition-colors duration-500">
                        <i class="ph ph-armchair text-2xl"></i>
                    </div>
                    <h4 class="text-[11px] uppercase tracking-[0.3em] font-bold mb-4">Artesanía</h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed">
                        Maestría en cada trazo. Nuestras piezas son creadas por manos que preservan el legado de la
                        artesanía clásica para dar vida a formas contemporáneas.
                    </p>
                </div>

                <!-- SOSTENIBILIDAD -->
                <div
                    class="bg-white/80 backdrop-blur-md p-10 hover-lift group border border-fashion-black/5 rounded-sm transition-all duration-500 lg:mt-8">
                    <div
                        class="w-12 h-12 mb-8 flex items-center justify-center border border-fashion-black/10 rounded-full group-hover:bg-fashion-accent group-hover:text-white transition-colors duration-500">
                        <i class="ph ph-leaf text-2xl"></i>
                    </div>
                    <h4 class="text-[11px] uppercase tracking-[0.3em] font-bold mb-4">Sostenibilidad</h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed">
                        Utilizamos materiales nobles de origen certificado y procesos de bajo impacto para proteger el
                        entorno que habitamos.
                    </p>
                </div>

                <!-- ATEMPORALIDAD -->
                <div
                    class="bg-white/80 backdrop-blur-md p-10 hover-lift group border border-fashion-black/5 rounded-sm transition-all duration-500">
                    <div
                        class="w-12 h-12 mb-8 flex items-center justify-center border border-fashion-black/10 rounded-full group-hover:bg-fashion-accent group-hover:text-white transition-colors duration-500">
                        <i class="ph ph-clock text-2xl"></i>
                    </div>
                    <h4 class="text-[11px] uppercase tracking-[0.3em] font-bold mb-4">Atemporalidad</h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed">
                        Diseñamos para el futuro. Nuestras piezas están concebidas para ignorar el calendario y durar
                        generaciones.
                    </p>
                </div>

                <!-- INNOVACIÓN -->
                <div
                    class="bg-white/80 backdrop-blur-md p-10 hover-lift group border border-fashion-black/5 rounded-sm transition-all duration-500 lg:mt-8">
                    <div
                        class="w-12 h-12 mb-8 flex items-center justify-center border border-fashion-black/10 rounded-full group-hover:bg-fashion-accent group-hover:text-white transition-colors duration-500">
                        <i class="ph ph-lightbulb text-2xl"></i>
                    </div>
                    <h4 class="text-[11px] uppercase tracking-[0.3em] font-bold mb-4">Innovación</h4>
                    <p class="text-sm text-gray-500 font-light leading-relaxed">
                        Exploramos materiales técnicos y fabricación digital para redefinir el confort y elevar la
                        experiencia del lujo contemporáneo
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- MATERIALES-->
    <section class="py-32 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                <!-- TEXTO DE MATERIALES -->
                <div class="lg:col-span-5 space-y-10 order-2 lg:order-1">
                    <div class="space-y-4">
                        <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-fashion-accent">Materiales</h2>
                        <h3 class="editorial-font text-5xl md:text-6xl italic leading-tight text-fashion-black">La
                            Calidad que se Siente
                        </h3>
                    </div>
                    <div class="space-y-6">
                        <p class="text-lg text-gray-700 font-light leading-relaxed">
                            No comprometemos la excelencia. Seleccionamos mármoles de Carrara de vetas únicas, robles
                            europeos de crecimiento lento y pieles de curtido vegetal que adquieren carácter con el paso
                            del tiempo.
                        </p>
                        <p class="text-lg text-gray-600 font-light leading-relaxed italic text-fashion-black">
                            "Para nosotros, el lujo es un sentimiento de comodidad absoluta y confianza inquebrantable."
                        </p>
                        <ul class="space-y-4 pt-4">
                            <li
                                class="flex items-center gap-4 text-xs uppercase tracking-widest font-semibold text-fashion-black">
                                <span class="w-8 h-px bg-fashion-accent"></span> Mármoles de Carrara
                            </li>
                            <li
                                class="flex items-center gap-4 text-xs uppercase tracking-widest font-semibold text-fashion-black">
                                <span class="w-8 h-px bg-fashion-accent"></span> Robles europeos
                            </li>
                            <li
                                class="flex items-center gap-4 text-xs uppercase tracking-widest font-semibold text-fashion-black">
                                <span class="w-8 h-px bg-fashion-accent"></span> Pieles de curtido vegetal
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- IMAGEN DE MATERIALES -->
                <div class="lg:col-span-7 relative order-1 lg:order-2">
                    <div class="relative w-full h-[500px] lg:h-[600px] overflow-hidden rounded-sm shadow-xl">
                        <img src="<?= $rutaWeb ?>/img/sobre-nosotros/detalles-materiales.png" alt="Craftsmanship Room"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-fashion-black/5 mix-blend-overlay"></div>
                    </div>
                    <!-- Decorative Elements simplified -->
                    <div
                        class="absolute -top-6 -right-6 w-24 h-24 border border-fashion-accent/20 hidden lg:block -z-10">
                    </div>
                    <div
                        class="absolute -bottom-6 -left-6 w-24 h-24 border border-fashion-accent/20 hidden lg:block -z-10">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOQUE DE CITA -->
    <section class="stats-gradient  py-40">
        <div class="max-w-4xl mx-auto px-6 lg:px-12 text-center space-y-4">
            <i class="ph ph-quotes text-6xl text-fashion-accent opacity-50"></i>
            <h2 class="editorial-font text-4xl md:text-6xl italic leading-tight">
                "Nuestra visión es dar forma al hogar como la expresión más íntima de su
                propia elegancia."
            </h2>
            <div class="flex items-center justify-center gap-6 pt-10">
                <a href="<?php echo $rutaWeb ?>" class="bton btn-primary !px-12 ">
                    Descubrir Norden Réka
                </a>
            </div>
        </div>
    </section>

</main>




<?php
include $rutaRaiz . '/src/plantillas/footer.php';
?>