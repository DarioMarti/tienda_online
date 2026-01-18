<?php
require '../plantillas/cabecera.php';
?>
<main class="min-h-screen bg-fashion-gray py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <h1 class="font-editorial text-5xl italic text-fashion-black mb-4">Finalizar Compra</h1>
            <p class="text-gray-500 text-xs uppercase tracking-[0.3em]">Casi has completado tu adquisición exclusiva</p>
        </div>
        <form id="checkout-form" action="#" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
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
                            <input type="email" name="email_contacto" required readonly
                                class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed text-gray-50 outline-none transition-colors text-sm"
                                value="marcos@gmail.com">
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label
                                class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Dirección</label>
                            <input type="text" name="direccion" required placeholder="Calle, número, piso..."
                                class="w-full px-4 py-3 bg-white border border-gray-100 focus:border-fashion-black outline-none transition-colors text-sm ">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">
                                Código Postal</label>
                            <input type="text" name="cp" required
                                class="w-full px-4 py-3 bg-white border border-gray-100 focus:border-fashion-black outline-none transition-colors text-sm">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Ciudad</label>
                            <input type="text" name="ciudad" required
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
                    <div class="flex-1 space-y-6 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar mb-10">

                        <div class="flex gap-4">
                            <div class="w-16 h-20 bg-fashion-gray overflow-hidden rounded-md flex-shrink-0">
                                <img src="#" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-bold uppercase tracking-widest truncate">
                                    Silla de diseño
                                </h4>
                                <p class="text-xs font-semibold mt-2">
                                    120,00 €
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- PRECIO -->
                    <div class="space-y-6 pt-6 border-t border-gray-50 mt-auto">
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span
                                    class="text-gray-400 uppercase tracking-widest text-[10px] font-bold">Subtotal</span>
                                <span class="font-medium">
                                    120,00 €
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
                                <span class="text-2xl font-editorial italic font-bold">
                                    130,00 €
                                </span>
                            </div>
                        </div>

                        <button type="submit" id="realizar-pago-btn" class="bton cursor-pointer w-full">
                            <span id="button-texto">Pagar Ahora con Stripe</span>
                        </button>

                    </div>
        </form>
    </div>

</main>
<?php
include '../plantillas/footer.html';
?>