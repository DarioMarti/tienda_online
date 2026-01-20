<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/modelos/carrito/vaciar-carrito.php';
vaciarCarrito();
require_once $rutaRaiz . '/src/plantillas/cabecera.php';

?>

<div class='min-h-[60vh] flex items-center justify-center px-6 py-20'>
    <div
        class='bg-white rounded-2xl shadow-xl p-8 md:p-12 max-w-lg w-full text-center border border-gray-100 transition-all hover:shadow-2xl'>
        <div
            class='w-20 h-20 bg-fashion-accent rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg shadow-fashion-accent/20'>
            <i class="ph ph-check text-white text-5xl"></i>
        </div>
        <h1 class='text-3xl font-bold text-fashion-black mb-4'>¡Pago Realizado con éxito!</h1>
        <p class='text-gray-600 text-lg mb-8'>Gracias por tu compra. Tu pedido ha sido procesado correctamente.</p>

        <?php if (isset($_SESSION['session_id'])): ?>
            <div class='bg-fashion-gray rounded-lg p-4 mb-8'>
                <p class='text-xs uppercase tracking-widest text-gray-500 mb-2'>ID de sesión de pago</p>
                <code
                    class='text-fashion-black font-mono break-all text-sm'><?= htmlspecialchars($_SESSION['session_id']) ?></code>
            </div>
        <?php endif; ?>

        <div class='flex flex-col gap-4'>
            <a href='mis-pedidos.php'
                class='w-full bg-fashion-black text-white py-4 text-xs hover:bg-fashion-accent transition-colors uppercase tracking-widest font-semibold rounded-lg shadow-md'>
                Ver Mis Pedidos
            </a>
            <a href='index.php'
                class='w-full bg-white text-fashion-black border border-fashion-black py-4 text-xs hover:bg-fashion-gray transition-colors uppercase tracking-widest font-semibold rounded-lg'>
                Volver a la Tienda
            </a>
        </div>

        <div class='mt-12 pt-8 border-t border-gray-100 text-gray-500 text-sm italic'>
            <p>Recibirás un correo electrónico con los detalles de tu pedido.</p>
        </div>
    </div>
</div>



<?php
include $rutaRaiz . '/src/plantillas/footer.php';
?>