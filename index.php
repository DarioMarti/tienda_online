<?php

session_start();
$titulo = "Inicio - Norder Réka";
require '../plantillas/cabecera.php';
$heroImage = "../../img/globales/CabeceraHome.webp";

require '../../modelos/categoria/mostrar-categoria.php';
require '../../modelos/producto/mostrar-productos.php';

$categorias = mostrarCategorias();

$filtroBusqueda = $_GET['busqueda'] ?? '';
$filtroCategoria = $_GET['categoria'] ?? '';
$filtroPrecio = $_GET['precio'] ?? '';
$filtroOrden = $_GET['orden'] ?? '';
$productos = mostrarProductos($filtroBusqueda, $filtroOrden, $filtroCategoria, $filtroPrecio);

?>
<!-- HERO IMAGE -->
<section
    class="flex flex-col justify-center items-center h-[60vh] w-full overflow-hidden text-center text-white px-4 bg-gradient-to-b from-black/40 to-black/20"
    style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('<?= $heroImage ?>') center top / cover no-repeat;">

    <p class="font-family-sans uppercase tracking-[0.3em] text-xs mb-4 ">Fall Winter 2025</p>
    <h2 class="font-family-sans text-5xl md:text-7xl mb-6 italic">
        La Colección
    </h2>

</section>

<!-- BLOQUE CENTRAL -->
<div class="w-full px-6 lg:px-12 py-16">

    <main class="flex flex-col lg:flex-row gap-12">
        <!-- ASIDE - BARRA LATERAL - FILTROS -->
        <aside class="w-full lg:w-1/5 2xl:w-1/6 hidden lg:block">
            <div class="sticky top-32 space-y-12 pr-6 border-r border-gray-100 h-full">
                <!-- CATEGORÍAS -->
                <div>
                    <h3 class="editorial-font text-2xl mb-6 italic">Categorías</h3>
                    <ul class="space-y-4 text-sm tracking-wide font-light text-gray-900 pb-2">
                        <?php foreach ($categorias as $categoria):
                            $categoriaPadre = $categoria['id'] ?>
                            <?php if ($categoria['categoria_padre_id'] == null): ?>
                                <li>
                                    <span onclick="filtrarCategoria('<?= $categoria['nombre'] ?>')"
                                        class="flex items-center gap-2 hover:text-fashion-accent transition-colors cursor-pointer"
                                        id="categoria-<?php echo $categoria['nombre']; ?>">
                                        <i class="ph ph-arrow-right"></i>
                                        <span><?= $categoria['nombre'] ?></span>
                                    </span>
                                    <ul>
                                        <?php foreach ($categorias as $categoriaHija): ?>
                                            <?php if ($categoriaHija['categoria_padre_id'] == $categoria['id']): ?>
                                                <li onclick="filtrarCategoria('<?= $categoriaHija['nombre'] ?>')"
                                                    id="categoria-<?php echo $categoriaHija['nombre']; ?>"
                                                    class="ml-10 text-2xs text-gray-400 py-1 flex items-center gap-2 hover:text-fashion-accent transition-colors cursor-pointer">
                                                    <span><?= $categoriaHija['nombre'] ?></span>
                                                </li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                                <?php
                            endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Precio -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="uppercase text-xs tracking-widest font-semibold text-gray-400">Precio</h4>
                        <span id="valor-precio-actual" class="text-xs font-bold text-fashion-black">
                            200€
                        </span>
                    </div>
                    <input type="range" id="filtro-precio-deslizador" min="0" max="2000" step="10" value="200"
                        class="w-full h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-fashion-black">
                    <div class="flex justify-between text-[10px] mt-2 text-gray-400 uppercase tracking-tighter">
                        <span>0€</span>
                        <span>2000€</span>
                    </div>
                    <button id="filtrar-precio-btn" class="bton w-full mt-8">
                        Filtrar productos
                    </button>
                    <button id="limpiar-filtros-btn" class="w-full bton_secundario mt-4">
                        Limpiar filtros
                    </button>
                </div>
            </div>

        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <section class="w-full lg:w-4/5 2xl:w-5/6">
            <div class="flex  flex-col md:flex-row justify-end mb-10 pb-4 items-baseline gap-4 mt-4 md:mt-0">
                <span class="text-sm text-gray-500"> <?php echo count($productos) ?> Resultados</span>
                <form method="GET">
                    <select name="orden" id="ordenar-productos" onchange="this.form.submit()"
                        class="border border-gray-200 text-sm bg-transparent font-medium focus:ring-0 cursor-pointer py-2 px-4 rounded-md">
                        <option value="">Ordenar por</option>
                        <option value="precio_asc">Precio: Bajo a Alto</option>
                        <option value="precio_desc">Precio: Alto a Bajo</option>
                        <option value="Alfabético_asc">Alfabético: A-Z</option>
                        <option value="Alfabético_desc">Alfabético: Z-A</option>
                        <option value="recientes">Más recientes</option>
                    </select>
                </form>
            </div>
            <!-- CATÁLOGO DE PRODUCTOS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-12">
                <?php foreach ($productos as $producto): ?>
                    <div class="group cursor-pointer">
                        <div class="hidden id-producto-catalogo" name="id-producto-catalogo">
                            <?php echo $producto['id']; ?>
                        </div>
                        <a href="#" class="block">
                            <div class="relative overflow-hidden mb-4 bg-gray-50 aspect-[1/1]">
                                <img src="../../<?= $producto['imagen'] ?>"
                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110"
                                    alt="<?= $producto['descripcion'] ?>">

                                <!--ETIQUETA DESCUENTO -->
                                <?php if ($producto['descuento'] > 0): ?>
                                    <div class="absolute top-0 left-0 p-3 flex flex-col gap-2 items-start">
                                        <span
                                            class="bg-red-600 text-white text-xs font-bold px-3 py-1 text-center uppercase tracking-widest">-<?php echo intval($producto['descuento']); ?>%</span>
                                    </div>
                                <?php endif ?>
                                <div
                                    class="absolute inset-0 p-4 opacity-0 group-hover:opacity-100 transition-all duration-500 bg-black/20 flex flex-col justify-end">

                                    <button onclick="agregarCarritoAPI(<?php echo $producto['id']; ?>)"
                                        class=" cursor-pointer w-full bg-black text-white hover:bg-fashion-accent hover:text-white text-[10px] font-bold uppercase tracking-widest py-3 transition-colors rounded-sm shadow-xl">
                                        Añadir a la cesta
                                    </button>
                                </div>
                            </div>
                        </a>
                        <div>
                            <a href="#">
                                <h3 class="editorial-font text-xl group-hover:text-fashion-accent transition-colors">
                                    <?php echo $producto['nombre'] ?>
                                </h3>
                            </a>
                            <p class="text-[10px] text-gray-500 uppercase tracking-wider mt-1 mb-2">
                                <?php echo $producto['descripcion'] ?>
                            </p>
                            <?php if ($producto['descuento'] > 0): ?>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-md text-gray-400 line-through">
                                        <?php echo $producto['precio'] ?>€
                                    </span>
                                    <p class="font-medium text-md text-red-600">
                                        <?php
                                        $precioFinal = $producto['precio'] - ($producto['descuento'] * $producto['precio']) / 100;
                                        echo $precioFinal ?>€
                                    </p>
                                </div>
                            <?php else: ?>
                                <p class="text-md text-gray-400">
                                    <?php echo $producto['precio'] ?>€
                                </p>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>

    </main>

</div>










<?php
include '../plantillas/footer.html';
?>