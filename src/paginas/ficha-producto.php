<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();
$titulo = "Ficha Producto";

require $rutaRaiz . '/src/plantillas/cabecera.php';
require_once ruta_raiz() . '/config/conexionDB.php';


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: " . $rutaWeb);
    exit();
}

$conn = conectar();

$sentenciaProductos = $conn->prepare("SELECT * FROM productos WHERE id = ? AND activo = 1");
$sentenciaProductos->execute([$id]);
$producto = $sentenciaProductos->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header("Location: " . $rutaWeb);
    exit();
}

?>

<main class="max-w-[1800px] mx-auto px-6 mb-20 pt-16">
    <div class="flex flex-col lg:flex-row gap-16 lg:gap-32">

        <!-- IMAGEN DEL PRODUCTO -->
        <div class="w-full lg:w-1/2 flex flex-col gap-4">
            <div class="bg-gray-100 aspect-[3/4] overflow-hidden relative">
                <img src="<?php echo ruta_web() . '/' . $producto['imagen']; ?>"
                    alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- INFO DEL PRODUCTO -->
        <div class="w-full lg:w-1/2 text-fashion-black">
            <div class="lg:sticky lg:top-24 space-y-8">

                <!-- CABECERA -->
                <div class="space-y-2">
                    <h1 class="font-editorial text-4xl uppercase tracking-wide">
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </h1>
                    <?php if ($producto['descuento'] > 0): ?>
                        <span class="flex items-center gap-2">
                            <p class="text-xl font-medium line-through">
                                <?php echo number_format($producto['precio'], 2, ',', '.'); ?> €
                            </p>
                            <p class="text-xl font-medium text-red-500">
                                <?php echo number_format(($producto['precio'] - ($producto['precio'] * $producto['descuento'] / 100)), 2, ',', '.'); ?>
                                €
                            </p>
                        </span>
                    <?php else: ?>
                        <p class="text-xl font-medium"><?php echo number_format($producto['precio'], 2, ',', '.'); ?> €
                        </p>
                    <?php endif; ?>
                </div>
                <div class="h-px bg-gray-200"></div>

                <!-- DESCRIPCION -->
                <div class="text-sm text-gray-600 leading-7 font-light">
                    <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
                </div>

                <div class="space-y-6 pt-4">

                    <!-- AÑADIR A LA CESTA -->
                    <button id="agregar-carrito-btn" onclick="agregarCarritoAPI(<?php echo $producto['id']; ?>)"
                        class="w-full bg-black text-white py-4 text-xs uppercase tracking-[0.2em] font-bold hover:bg-fashion-accent transition-colors cursor-pointer">
                        Añadir a la Cesta
                    </button>

                    <!-- DETALLES DEL PRODUCTO Y ENVIO -->
                    <div class="grid grid-cols-2 gap-4 text-center py-4 border-t border-b border-gray-100">
                        <div class="flex flex-col items-center gap-2">
                            <i class="ph ph-truck text-xl"></i>
                            <span class="text-[10px] uppercase font-bold tracking-widest">Envío Gratis</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 border-l border-gray-100">
                            <i class="ph ph-arrow-counter-clockwise text-xl"></i>
                            <span class="text-[10px] uppercase font-bold tracking-widest">Devoluciones</span>
                        </div>
                    </div>
                </div>

                <section>
                    <article class="group py-4 border-b border-gray-100 cursor-pointer">
                        <summary
                            class="flex justify-between items-center text-[11px] uppercase font-bold tracking-widest list-none">
                            Composición
                            <span class="text-lg transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="pt-4 text-sm text-gray-500 font-light">
                            Fabricado con los mejores materiales seleccionados por Norder Reka.
                        </div>
                    </article>
                    <article class="group py-4 border-b border-gray-100 cursor-pointer">
                        <summary
                            class="flex justify-between items-center text-[11px] uppercase font-bold tracking-widest list-none">
                            Envíos y Devoluciones
                            <span class="text-lg transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="pt-4 text-sm text-gray-500 font-light">
                            Plazo de entrega de 2 a 4 días laborables. Los gastos de envío son gratuitos en pedidos
                            superiores a 300€.
                        </div>
                    </article>
                </section>

            </div>
        </div>
    </div>
</main>

<?php
include $rutaRaiz . '/src/plantillas/footer.php';
?>