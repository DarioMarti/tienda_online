<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/src/plantillas/cabecera.php';
?>
<div class='min-h-[60vh] flex items-center justify-center px-6 py-20'>
    <div
        class='bg-white rounded-2xl shadow-xl p-8 md:p-12 max-w-lg w-full text-center border border-gray-100 transition-all hover:shadow-2xl'>
        <div
            class='w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg shadow-gray-200/20'>
            <i class="ph ph-x text-gray-600 text-5xl"></i>
        </div>
        <h1 class='text-3xl font-bold text-fashion-black mb-4'>Pago Cancelado</h1>
        <p class='text-gray-600 text-lg mb-8'>Has cancelado el proceso de pago.</p>

        <div class='flex flex-col gap-4'>
            <a href='checkout.php'
                class='w-full bg-fashion-black text-white py-4 text-xs hover:bg-fashion-accent transition-colors uppercase tracking-widest font-semibold rounded-lg shadow-md'>
                Volver al Carrito
            </a>
            <a href='index.php'
                class='w-full bg-white text-fashion-black border border-fashion-black py-4 text-xs hover:bg-fashion-gray transition-colors uppercase tracking-widest font-semibold rounded-lg'>
                Volver a la Tienda
            </a>
        </div>

        <div class='mt-12 pt-8 border-t border-gray-100 text-gray-500 text-sm'>
            <p>Tus productos siguen en el carrito.</p>
            <p class='mt-2'>Puedes completar tu compra cuando estés listo.</p>
        </div>
    </div>
</div>

<?php
include $rutaRaiz . '/src/plantillas/footer.php';
?>