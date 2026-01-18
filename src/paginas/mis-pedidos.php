<?php
session_start();
require '../../config/seguridad.php';
restringirAccesoVisitantes();

require '../plantillas/cabecera.php';
require '../../modelos/pedido/mostrar-pedidos.php';
$pedidos = mostrarPedidos();
$misPedidos = [];

foreach ($pedidos as $pedido) {
    if ($pedido['usuario_id'] == $_SESSION['usuario']['id']) {
        $misPedidos[] = $pedido;
    }
}
?>

<main class="min-h-screen bg-fashion-gray py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- CABECERA DE LA PÁGINA -->
        <div class="mb-12">
            <h1 class="font-editorial text-4xl italic text-fashion-black mb-4">Mis Historial de Pedidos</h1>
            <p class="text-gray-500 text-xs uppercase tracking-[0.3em]">Gestiona y revisa tus adquisiciones exclusivas
            </p>
        </div>

        <!-- BLOQUE DE PEDIDOS -->
        <section class="space-y-6">
            <?php if (!$misPedidos): ?>
                <div class="bg-white rounded-lg shadow-xl p-20 text-center">
                    <div class="mb-2">
                        <i class="ph ph-shopping-bag text-6xl text-gray-200"></i>
                    </div>
                    <h2 class="font-editorial text-3xl  text-fashion-black mb-4">Aún no has realizado pedidos</h2>
                    <p class="text-gray-500 text-sm uppercase tracking-widest mb-12">Te invitamos a explorar nuestra última
                        colección</p>
                    <a href="index.php" class="bton !px-16 transition-all duration-300">
                        Ir a la Tienda
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($misPedidos as $pedido): ?>
                    <div
                        class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <!-- CABECERA DEL PEDIDO -->
                        <div
                            class="bg-gray-50 px-8 py-5 flex flex-wrap justify-between items-center border-b border-gray-100 gap-4">
                            <div class="flex items-center gap-16">
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Pedido Realizado</p>
                                    <p class="text-sm font-semibold text-fashion-black">
                                        <?php echo $pedido['fecha']; ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Total</p>
                                    <p class="text-sm font-bold text-fashion-black">
                                        <?php echo $pedido['coste_total']; ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Enviar a</p>
                                    <p class="text-sm font-semibold text-fashion-black">
                                        <?php echo $pedido['nombre_destinatario']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">Pedido #
                                    <?php echo $pedido['id']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex flex-wrap items-center justify-between gap-8">
                                <div class="flex items-center gap-6">
                                    <?php
                                    $estadoEstilos = [
                                        'pendiente' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                        'pagado' => 'bg-green-50 text-green-700 border-green-100',
                                        'enviado' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'entregado' => 'bg-purple-50 text-purple-700 border-purple-100',
                                        'cancelado' => 'bg-red-50 text-red-700 border-red-100'
                                    ];
                                    ?>
                                    <div
                                        class="px-4 py-2 rounded-full border text-xs font-bold uppercase tracking-widest <?php echo $estadoEstilos[$pedido['estado']]; ?>">
                                        <i class="ph ph-info mr-2"></i>
                                        <?php echo $pedido['estado']; ?>
                                    </div>
                                    <?php if ($pedido['estado'] == 'pendiente'): ?>
                                        <p class="text-sm text-gray-600">
                                            <strong>Nota:</strong> Estamos procesando tu pedido
                                        </p>
                                    <?php elseif ($pedido['estado'] == 'pagado'): ?>
                                        <p class="text-sm text-gray-600">
                                            <strong>Nota:</strong> Tu pedido ha sido pagado
                                        </p>
                                    <?php elseif ($pedido['estado'] == 'enviado'): ?>
                                        <p class="text-sm text-gray-600">
                                            Tu pedido ha sido enviado
                                        </p>
                                    <?php elseif ($pedido['estado'] == 'entregado'): ?>
                                        <p class="text-sm text-gray-600">
                                            Tu pedido ha sido entregado
                                        </p>
                                    <?php elseif ($pedido['estado'] == 'cancelado'): ?>
                                        <p class="text-sm text-gray-600">
                                            Tu pedido ha sido cancelado
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="flex gap-4">
                                    <button onclick="cerrarModalDetallesPedido(<?php echo $pedido['id']; ?>)"
                                        class="cursor-pointer bton_secundario !px-8 !text-xs">
                                        Detalles del pedido
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
        <!-- SECCIÓN DE AYUDA -->
        <div
            class="mt-16 bg-white rounded-lg p-12 border border-gray-100 flex flex-wrap items-center justify-between gap-8">
            <div>
                <h3 class="font-editorial text-2xl text-fashion-black mb-2">¿Necesitas asistencia?</h3>
                <p class="text-gray-500 text-sm">Nuestro equipo de conserjería está disponible para cualquier duda sobre
                    tus pedidos.</p>
            </div>
            <div class="flex gap-8">
                <div class="flex flex-col">
                    <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Llámanos</p>
                    <p class="text-sm font-semibold text-fashion-black">+34 900 123 456</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Escríbenos</p>
                    <p class="text-sm font-semibold text-fashion-black">support@aetheria.com</p>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- MODAL DETALLES DE PEDIDO -->
<div id="modal-detalles-pedido" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center z-10">
            <div>
                <h2 class="font-editorial text-3xl italic text-fashion-black">Detalles del Pedido <span
                        id="det-id-pedido"></span></h2>
                <p class="text-gray-500 text-sm mt-1" id="det-fecha-pedido"></p>
            </div>
            <button onclick="cerrarModalDetallesPedido()"
                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>

        <div class="p-8">
            <!-- INFORMACIÓN DEL PEDIDO -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                    <h3 class="text-xs uppercase tracking-widest font-bold text-gray-500 mb-4">Estado del Pedido</h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="font-semibold text-gray-700">Estado Actual:</span>
                            <span id="det-etiqueta-estado"
                                class="px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase"></span>
                        </div>
                        <p class="text-gray-500 text-xs">Si tienes alguna duda sobre el estado de tu pedido, contacta
                            con nuestro servicio de atención al cliente.</p>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                    <h3 class="text-xs uppercase tracking-widest font-bold text-gray-500 mb-4">Dirección de Entrega</h3>
                    <div class="space-y-2 text-sm">
                        <p id="det-nombre-receptor" class="font-bold text-fashion-black"></p>
                        <p id="det-direccion-envio" class="text-gray-700"></p>
                        <p id="det-ubicacion-envio" class="text-gray-700"></p>
                    </div>
                </div>
            </div>

            <!-- TABLA DE PRODUCTOS DEL PEDIDO -->
            <div>
                <h3 class="text-xs uppercase tracking-widest font-bold text-gray-500 mb-4">Artículos del Pedido</h3>
                <div class="overflow-x-auto border border-gray-100 rounded-lg">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th id="det-nombre-item"
                                    class="px-6 py-3 text-xs uppercase tracking-widest font-bold text-gray-500">Producto
                                </th>
                                <th id="det-cantidad-item"
                                    class="px-6 py-3 text-xs uppercase tracking-widest font-bold text-gray-500 text-center">
                                    Cant.</th>
                                <th id="det-precio-item"
                                    class="px-6 py-3 text-xs uppercase tracking-widest font-bold text-gray-500 text-right">
                                    Precio</th>
                                <th id="det-subtotal-item"
                                    class="px-6 py-3 text-xs uppercase tracking-widest font-bold text-gray-500 text-right">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody id="det-lista-items" class="divide-y divide-gray-100">
                            <!-- Items dinámicos -->
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50 font-bold border-t-2 border-fashion-black">
                                <td colspan="3" class="px-6 py-4 text-right uppercase tracking-widest text-xs">Importe
                                    Total</td>
                                <td class="px-6 py-4 text-right text-xl text-fashion-black" id="det-total-pedido">0.00 €
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<?php
include '../plantillas/footer.html';
?>