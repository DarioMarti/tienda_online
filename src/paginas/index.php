<?php

require '../plantillas/cabecera.php';
$heroImage = "../../img/Hero-Imagen.jpg";
?>
<!-- HERO IMAGE -->
<section class="flex flex-col justify-center items-center h-[60vh] w-full overflow-hidden text-center text-white px-4 "
    style="background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('<?= $heroImage ?>') center top / cover no-repeat;">

    <p class="font-family-sans uppercase tracking-[0.3em] text-xs mb-4 ">Fall Winter 2025</p>
    <h2 class="font-family-sans text-5xl md:text-7xl mb-6 italic">
        La Colección
    </h2>

</section>

<!-- BLOQUE CENTRAL -->
<div class="w-full px-6 lg:px-12 py-16">

    <main class="flex flex-col lg:flex-row gap-12">
        <!-- ASIDE - BARRA LATERAL -->
        <aside class="w-full lg:w-1/5 2xl:w-1/6 hidden lg:block">
            <!-- CATEGORÍAS -->
            <div>
                <h1>Gorros</h1>
            </div>
            <!--FILTROS-->
            <div></div>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <section class="w-full lg:w-4/5 2xl:w-5/6">
            <div class="flex  flex-col md:flex-row justify-end mb-10 pb-4 items-baseline gap-4 mt-4 md:mt-0">
                <span class="text-sm text-gray-500">14 Resultados</span>
                <form method="GET">
                    <select name="orden" onchange="this.form.submit()"
                        class="border border-gray-200 text-sm bg-transparent font-medium focus:ring-0 cursor-pointer py-2 px-4 rounded-md">
                        <option value="">Ordenar por</option>
                        <option value="precio_asc">Precio: Bajo a Alto</option>
                        <option value="precio_desc">Precio: Alto a Bajo</option>
                        <option value="recientes">Más recientes</option>
                    </select>
                </form>
            </div>
            <!-- CATÁLOGO DE PRODUCTOS -->
            <div>
                <h1>AQUI LOS PRODUCTOS</h1>
            </div>
        </section>

    </main>

</div>










<?php
include '../plantillas/footer.html';
?>