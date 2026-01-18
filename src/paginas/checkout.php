<?php
session_start();
require '../plantillas/cabecera.php';
$productos = $_SESSION['carrito']['productos'];
?>

<main class="min-h-screen bg-fashion-gray py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <h1 class="font-editorial text-5xl italic text-fashion-black mb-4">Finalizar Compra</h1>
            <p class="text-gray-500 text-xs uppercase tracking-[0.3em]">Casi has completado tu adquisición exclusiva</p>
        </div>
        <form id="checkout-form" action="../../modelos/pedido/crear-pedido.php" method="POST"
            class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            <input type="hidden" name="ruta-actual" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <!-- BLOQUE IZQUIERDA - DATOS DEL CLIENTE -->
            <div class="space-y-12 w-full lg:col-span-2">
                <!-- 1. DATOS DE ENVIO -->
                <section class="space-y-6">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold border-b border-gray-200 pb-4">1. Datos de
                        Envío</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                                Nombre Completo</label>
                            <input type="text" name="nombre_destinatario" required
                                class="w-full px-4 py-3 bg-white border border-gray-100 focus:border-fashion-black outline-none transition-colors text-sm"
                                value="Marcos Perea">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Email</label>
                            <input type="email" name="usuario_email" required readonly
                                class="w-full px-4 py-3 bg-gray-300 border border-gray-300 rounded-lg cursor-not-allowed text-gray-500 outline-none transition-colors text-sm"
                                value="<?= $_SESSION['usuario']['email'] ?>">
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label
                                class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Dirección</label>
                            <input type="text" name="direccion_envio" required placeholder="Calle, número, piso..."
                                class="w-full px-4 py-3 bg-white border border-gray-100 focus:border-fashion-black outline-none transition-colors text-sm ">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                                Ciudad</label>
                            <input type="text" name="ciudad" required
                                class="w-full px-4 py-3 bg-white border border-gray-100 focus:border-fashion-black outline-none transition-colors text-sm">
                        </div>
                        <div class="space-y-2">
                            <label
                                class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Provincia</label>
                            <input type="text" name="provincia" required
                                class="w-full px-4 py-3 bg-white border border-gray-100 focus:border-fashion-black outline-none transition-colors text-sm">
                        </div>
                    </div>
                </section>

                <!-- MÉTODO DE PAGO -->
                <section class="space-y-4">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold border-b border-gray-200 pb-4">
                        2. Método de Pago
                    </h2>
                    <div id="payment-element" class="bg-white p-6 rounded-lg border border-gray-100">
                    </div>
                    <div id="payment-message" class="hidden text-red-500 text-xs text-center mt-2"></div>
                </section>
            </div>
            <!-- BLOQUE DERECHO - RESUMEN DEL PEDIDO -->
            <div class="lg:sticky lg:top-32 w-full mt-10 lg:mt-0 lg:col-span-1">
                <div class="bg-white p-10 rounded-lg border border-gray-100 shadow-sm flex flex-col h-full">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold border-b border-gray-50 pb-4 mb-8">
                        Resumen de Pedido
                    </h2>
                    <!-- LISTA DE PRODUCTOS -->
                    <?php foreach ($productos as $indice => $producto): ?>
                        <input type="hidden" name="productos[]" value="<?= $producto['id'] ?>">
                        <input type="hidden" name="stock[]" value="<?= $_SESSION['carrito']['cantidad'][$indice] ?>">
                        <div class="flex-1 space-y-6 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar mb-10">

                            <div class="flex gap-4">
                                <div class="w-16 h-20 bg-fashion-gray overflow-hidden rounded-md flex-shrink-0">
                                    <img src="../../<?= $producto['imagen'] ?>" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs font-bold uppercase tracking-widest truncate">
                                        <?= $producto['nombre'] ?>
                                    </h4>
                                    <p class="text-xs font-semibold mt-2">
                                        <?=
                                            $precioFinal = $producto['precio'] * $_SESSION['carrito']['cantidad'][$indice];
                                        $precioFinal ?> €
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- PRECIO -->
                    <div class="space-y-6 pt-6 border-t border-gray-50 mt-auto">
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span
                                    class="text-gray-400 uppercase tracking-widest text-[10px] font-bold">Subtotal</span>
                                <span class="font-medium">
                                    <?php echo $_SESSION['carrito']['total']; ?> €
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 uppercase tracking-widest text-[10px] font-bold">
                                    Gastos de Envío</span>
                                <span class="font-medium">
                                    10,00 €
                                </span>
                            </div>
                            <hr class="border-fashion-gray my-4">
                            <div class="flex justify-between items-center pt-2">
                                <span class="text-xs uppercase tracking-[0.2em] font-black">Total a Pagar</span>
                                <input type="text" name="coste_total"
                                    class="text-2xl font-editorial italic font-bold hidden"
                                    value="<?php echo $_SESSION['carrito']['total'] + 10; ?>">
                                <span class="text-2xl font-editorial italic font-bold">
                                    <?php echo $_SESSION['carrito']['total'] + 10; ?> €
                                </span>
                            </div>
                        </div>

                        <input type="hidden" name="estado" value="pendiente">
                        <button type="submit" id="realizar-pago-btn" class="bton cursor-pointer w-full">
                            <span id="button-texto">Pagar Ahora con Stripe</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</main>
<?php
include '../plantillas/footer.html';
?>