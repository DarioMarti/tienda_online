<?php
session_start();
require '../../config/seguridad.php';
restringirAccesoVisitantes();

require '../plantillas/cabecera.php';
?>
<main class="min-h-screen bg-fashion-gray py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- CABECERA DE PERFIL -->
        <div class="bg-white rounded-lg shadow-xl p-8 mb-8">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="font-editorial text-4xl italic text-fashion-black mb-2">
                        <?php echo $_SESSION['usuario']['nombre'] ?>
                    </h1>
                    <p class="text-gray-600 text-sm uppercase tracking-widest">
                        <?php echo $_SESSION['usuario']['email'] ?>
                    </p>
                </div>
                <span class="px-3 py-1 bg-fashion-accent text-white text-xs uppercase tracking-wider rounded-full">
                    <?php echo $_SESSION['usuario']['rol'] ?>
                </span>
            </div>
        </div>

        <!--SECCIÓN DE PERFIL -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!--COLUMNA IZQUIERDA-DATOS USUARIO-->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-lg shadow-xl p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-titulos text-2xl italic text-fashion-black">Datos Personales</h2>
                        <button onclick="abrirCerrarModalEditarPerfil()"
                            class="text-xs font-titulos uppercase tracking-widest text-fashion-black hover:text-fashion-accent transition-colors font-semibold cursor-pointer">
                            <i class="ph ph-pencil-simple mr-2"></i>Editar
                        </button>
                    </div>
                    <!-- INFO DATOS USUARIO -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NOMBRE -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-titulos uppercase tracking-widest font-semibold text-gray-500">Nombre</label>
                            <div id="display-nombre"
                                class="w-full px-4 mt-3 py-3 font-general bg-fashion-gray border border-gray-200 rounded-lg text-fashion-black">
                                <?php echo $_SESSION['usuario']['nombre'] ?>
                            </div>
                        </div>

                        <!-- APELLIDOS -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-titulos uppercase tracking-widest font-semibold text-gray-500">Apellidos</label>
                            <div id="display-apellidos"
                                class="w-full px-4 mt-3 py-3 font-general bg-fashion-gray border border-gray-200 rounded-lg text-fashion-black">
                                <?php echo $_SESSION['usuario']['apellido'] ?? "No indicado" ?>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-titulos uppercase tracking-widest font-semibold text-gray-500">Email</label>
                            <div
                                class="w-full mt-3 font-general px-4 py-3 bg-fashion-gray border border-gray-200 rounded-lg text-fashion-black">
                                <?php echo $_SESSION['usuario']['email'] ?>
                            </div>
                        </div>

                        <!-- TELÉFONO -->
                        <div class="space-y-2">
                            <label
                                class="text-xs font-titulos uppercase tracking-widest font-semibold text-gray-500">Teléfono</label>
                            <div id="display-telefono"
                                class="w-full mt-3 font-general px-4 py-3 bg-fashion-gray border border-gray-200 rounded-lg text-fashion-black">
                                <?php echo $_SESSION['usuario']['telefono'] ?>
                            </div>
                        </div>

                        <!-- DIRECCIÓN -->
                        <div class="space-y-2 md:col-span-2">
                            <label
                                class="text-xs font-titulos uppercase tracking-widest font-semibold text-gray-500">Dirección</label>
                            <div id="display-direccion"
                                class="w-full mt-3 font-general px-4 py-3 bg-fashion-gray border border-gray-200 rounded-lg text-fashion-black min-h-[80px]">
                                <?php echo $_SESSION['usuario']['direccion'] ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div>
                    <!-- PEDIDOS DEL USUARIO -->
                    <div class="bg-white rounded-lg shadow-xl p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="font-editorial text-2xl italic text-fashion-black">Mis Pedidos</h2>
                            <span class="text-xs uppercase tracking-widest text-gray-500 font-semibold">
                                <i class="ph ph-package mr-2"></i>
                                23 Pedidos
                            </span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 border-b border-gray-100">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500">
                                            ID</th>
                                        <th
                                            class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500">
                                            Fecha</th>
                                        <th
                                            class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500">
                                            Estado</th>
                                        <th
                                            class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500 text-right">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3 font-bold text-fashion-black">#23</td>
                                        <td class="px-4 py-3 text-xs text-gray-500">
                                            14/01/2026
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 rounded-full text-[10px] font-semibold uppercase tracking-wider 
                                                    bg-green-100 text-green-700">
                                                Entregado
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-right font-bold text-fashion-black">
                                            200€
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUMNA DERECHA -->
            <div class="space-y-6">
                <!-- CAMBIAR CONTRASEÑA -->
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <h3 class="font-titulos text-xl italic text-fashion-black mb-4">Seguridad</h3>
                    <button onclick="abrirCerrarModalCambiarContrasena()"
                        class="cursor-pointer w-full bg-fashion-gray text-fashion-black py-3 px-4 text-xs uppercase tracking-widest font-semibold hover:bg-fashion-black hover:text-white transition-all duration-300 rounded-lg">
                        <i class="ph ph-lock-key mr-2"></i>Cambiar Contraseña
                    </button>
                </div>
                <!-- PREFERENCIAS -->
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <h3 class="font-titulos text-xl italic text-fashion-black mb-4">Preferencias</h3>
                    <div class="space-y-3">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-sm text-gray-700">Recibir Newsletter</span>
                            <input type="checkbox"
                                class="rounded border-gray-300 text-fashion-black focus:ring-fashion-black">
                        </label>
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-sm text-gray-700">Notificaciones de Pedidos</span>
                            <input type="checkbox" checked
                                class="rounded border-gray-300 text-fashion-black focus:ring-fashion-black">
                        </label>
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-sm text-gray-700">Ofertas Exclusivas</span>
                            <input type="checkbox"
                                class="rounded border-gray-300 text-fashion-black focus:ring-fashion-black">
                        </label>
                    </div>
                </div>
                <!-- RESUMEN DE PEDIDOS -->
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <h3 class="font-editorial text-xl italic text-fashion-black mb-4">Resumen</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-xs uppercase tracking-widest text-gray-500">Total Pedidos</span>
                            <span class="text-2xl font-bold text-fashion-black">
                                12
                            </span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-xs uppercase tracking-widest text-gray-500">Total Gastado</span>
                            <span class="text-2xl font-bold text-fashion-black">
                                123€
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs uppercase tracking-widest text-gray-500">Miembro Desde</span>
                            <span class="text-sm text-gray-600">
                                14/01/2026

                        </div>
                    </div>
                </div>
                <!-- CERRAR SESIÓN -->
                <div class="bg-white rounded-lg shadow-xl p-6">
                    <a href="../../modelos/sesion/cerrar-sesion-usuario.php"
                        class="block w-full bg-red-600 text-white py-3 px-4 text-xs uppercase tracking-widest font-semibold hover:bg-red-700 transition-all duration-300 rounded-lg text-center">
                        <i class="ph ph-sign-out mr-2"></i>Cerrar Sesión
                    </a>
                </div>
                <!-- ELIMINAR CUENTA -->
                <button onclick="abrirModalEliminarCuenta()"
                    class="cursor-pointer block w-full py-3 px-4 text-xs uppercase tracking-widest font-semibold bg-gray-100 hover:bg-gray-200 text-red-600 transition-all duration-300 rounded-lg text-center"
                    id="eliminar-cuenta">
                    <i class="ph ph-trash mr-2"></i>Eliminar Cuenta
                </button>
            </div>
        </div>
    </div>
</main>

<!-- MODAL EDITAR DATOS DE USUARIO-->
<div id="modal-editar-perfil" class=" hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
            <h2 class="font-editorial text-3xl italic text-fashion-black">Editar Perfil</h2>
            <button onclick="abrirCerrarModalEditarPerfil()"
                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>
        <form class="p-8" action="../../modelos/usuario/editar-usuario.php" method="POST">
            <input type="hidden" name="ruta-actual-login" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- NOMBRE -->
                <div class="flex flex-col gap-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value=<?php echo $_SESSION['usuario']['nombre'] ?> required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors">
                </div>

                <!-- APELLIDOS -->
                <div class="flex flex-col gap-2">
                    <label class="text-xs uppercase tracking-widest font-semibold  text-gray-700">Apellidos</label>
                    <input type="text" name="apellidos" value="<?php echo $_SESSION['usuario']['apellido'] ?>" class="w-full px-4 py-3 border border-gray-300
                        rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors">
                </div>

                <!--EMAIL -->
                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Email</label>
                    <input type="email" value="<?php echo $_SESSION['usuario']['email'] ?>" disabled
                        class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 cursor-not-allowed">
                    <p class="text-xs text-gray-500 italic">El email no se puede modificar</p>
                </div>

                <!-- TELÉFONO -->
                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Teléfono</label>
                    <input type="tel" name="telefono" value="<?php echo $_SESSION['usuario']['telefono'] ?>"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors"
                        placeholder="+34 600 000 000">
                </div>

                <!-- DIRECCIÓN -->
                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Dirección</label>
                    <textarea name="direccion" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors resize-none"
                        placeholder="Calle, número, ciudad, código postal..."><?php echo $_SESSION['usuario']['direccion'] ?></textarea>
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button type="button" onclick="abrirCerrarModalEditarPerfil()"
                    class="cursor-pointer flex-1 bg-gray-200 text-gray-700 py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all duration-300 rounded-lg">
                    Cancelar
                </button>
                <button type="submit"
                    class="cursor-pointer flex-1 bg-fashion-black text-white py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all duration-300 rounded-lg shadow-lg hover:shadow-xl">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>


<!--MODAL DE CAMBIAR CONTRASEÑA-->
<div id="modal-cambiar-contrasena" class=" hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
        <div
            class="sticky top-0 bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center rounded-t-lg">
            <h2 class="font-editorial text-2xl italic text-fashion-black">Cambiar Contraseña</h2>
            <button onclick="abrirCerrarModalCambiarContrasena()"
                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>
        <form class="p-8" action="../../modelos/usuario/cambiar-contrasena.php" method="POST">
            <div class="space-y-4">
                <!-- CONTRASEÑA ACTUAL -->
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Contraseña
                        Actual</label>
                    <input type="password" name="actual_contrasena" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors">
                </div>

                <!-- NUEVA CONTRASEÑA -->
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Nueva
                        Contraseña</label>
                    <input type="password" name="nueva_contrasena" required minlength="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors">
                </div>

                <!-- CONFIRMAR NUEVA CONTRASEÑA -->
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Confirmar Nueva
                        Contraseña</label>
                    <input type="password" name="confirmar_contrasena" required minlength="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-fashion-black focus:outline-none focus:border-fashion-black transition-colors">
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button type="button" onclick="abrirCerrarModalCambiarContrasena()"
                    class="cursor-pointer flex-1 bg-gray-200 text-gray-700 py-3 px-4 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all duration-300 rounded-lg">
                    Cancelar
                </button>
                <button type="submit"
                    class="cursor-pointer flex-1 bg-fashion-black text-white py-3 px-4 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all duration-300 rounded-lg shadow-lg hover:shadow-xl">
                    Actualizar
                </button>
            </div>
        </form>
    </div>

</div>
<!-- MODAL DE RESULTADO -->
<?php
$tiposMensajes = [
    'categoria',
    'usuario',
    'producto',
    'pedido'
];
if (isset($_SESSION['mensaje']) && in_array($_SESSION['mensaje']['tipo'], $tiposMensajes)): ?>
    <div id="resultado-modal" class="resultado-modal fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center transform transition-all">

            <!-- CÍRCULO DEL ICONO -->
            <?php if ($_SESSION['mensaje']['estado'] == true) { ?>
                <div class="mb-6 w-16 h-16 bg-green-100 text-green-600 flex items-center justify-center rounded-full mx-auto">
                    <i class="ph ph-check text-3xl"></i>
                </div>
            <?php } else { ?>
                <div class="mb-6 w-16 h-16 bg-red-100 text-red-600 flex items-center justify-center rounded-full mx-auto">
                    <i class="ph ph-x text-3xl"></i>
                </div>
            <?php } ?>

            <!-- MENSAJE -->
            <p class="text-gray-600 mb-6">
                <?= htmlspecialchars($_SESSION['mensaje']['mensaje'] ?? '') ?>
            </p>

            <!-- BOTÓN CERRAR -->
            <button id="cerrar-modal" onclick="cerrarModalResultado()"
                class="cursor-pointer w-full bg-fashion-black text-white py-3 px-6 text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-all duration-300 rounded-lg">
                Cerrar
            </button>
        </div>
    </div>
<?php endif; ?>

<!-- MODAL DE CONFIRMACIÓN DE ELIMINACIÓN -->
<div id="eliminar-cuenta-modal" class=" hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-md w-full p-8 text-center transform transition-all">
        <div class="mb-4">
            <i class="ph ph-warning-circle text-6xl text-red-500"></i>
        </div>

        <h3 class="font-editorial text-2xl italic text-fashion-black mb-2">
            ¿Estás seguro?
        </h3>

        <p class="text-gray-600 mb-6">
            Esta acción eliminará permanentemente tu cuenta y no se puede deshacer.
        </p>

        <div class="flex gap-4">
            <button id="cancelar-eliminar-cuenta-btn" onclick="abrirModalEliminarCuenta()"
                class="cursor-pointer flex-1 bg-gray-200 text-gray-700 py-3 px-4 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all duration-300 rounded-lg">
                Cancelar
            </button>
            <a href="../../modelos/usuario/eliminar-usuario.php"
                class="cursor-pointer flex-1 bg-red-600 text-white py-3 px-4 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-red-700 transition-all duration-300 rounded-lg shadow-lg hover:shadow-xl">
                Eliminar
            </a>
        </div>
    </div>
</div>


<?php
include '../plantillas/footer.html';
?>