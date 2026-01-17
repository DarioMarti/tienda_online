<?php
$titulo = "Inicio - Aetheria";
require '../plantillas/cabecera.php';
$heroImage = "../../img/Hero-Imagen.jpg";

require '../../modelos/categoria/mostrar-categoria.php';
require '../../modelos/producto/mostrar-productos.php';

$categorias = mostrarCategorias();

$filtroBusqueda = $_GET['busqueda'] ?? '';
$productos = mostrarProductos($filtroBusqueda);

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
                                    <a href="#"
                                        class="flex items-center gap-2 hover:text-fashion-accent transition-colors categoria-<?php echo $categoria['nombre']; ?>">
                                        <i class="ph ph-arrow-right"></i>
                                        <span><?= $categoria['nombre'] ?></span>
                                    </a>
                                    <ul>
                                        <?php foreach ($categorias as $categoriaHija): ?>
                                            <?php if ($categoriaHija['categoria_padre_id'] == $categoria['id']): ?>
                                                <li class="ml-10 text-2xs text-gray-400 py-1">
                                                    <a href="#"
                                                        class="flex items-center gap-2 hover:text-fashion-accent transition-colors categoria-<?php echo $categoria['nombre']; ?>">
                                                        <span><?= $categoriaHija['nombre'] ?></span>
                                                    </a>
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
            </div>
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