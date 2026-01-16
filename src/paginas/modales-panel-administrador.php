<!-- MODAL USUARIO DE CREAR Y EDITAR -->
<div id="modal-usuario" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
            <h2 id="titulo-modal-usuario" class="font-editorial text-3xl italic text-fashion-black">Nuevo Usuario</h2>
            <button onclick="abrirCerrarModalCrearUsuario()"
                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>
        <form id="form-usuario" action="../../modelos/usuario/crear-usuario.php" method="POST" class="p-8"
            autocomplete="off">
            <input type="hidden" name="ruta-actual" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <input type="hidden" name="id" id="id-usuario">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre-usuario" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos-usuario"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email-usuario"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">

                </div>
                <div class="space-y-2 md:col-span-2" id="input-password">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Contraseña</label>
                    <input type="password" name="contrasena" id="password-usuario" autocomplete="new-password"
                        placeholder="******"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Rol</label>
                    <select name="rol" id="rol-usuario"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black bg-white">
                        <option value="cliente">Cliente</option>
                        <option value="empleado">Empleado</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Estado</label>
                    <select name="activo" id="activo-usuario"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black bg-white">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div id="seccion-datos-usuario-editar" class="md:col-span-2 grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" id="telefono-usuario"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                    </div>
                    <div class="space-y-2 ">
                        <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Dirección</label>
                        <input type="text" name="direccion" id="direccion-usuario"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">

                    </div>
                </div>
            </div>
            <div class="flex gap-4 mt-8">
                <button type="button" onclick="abrirCerrarModalCrearUsuario()"
                    class="flex-1 bg-gray-200 text-gray-700 py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all rounded-lg cursor-pointer">
                    Cancelar
                </button>
                <button type="submit"
                    class="flex-1 bg-fashion-black text-white py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all rounded-lg shadow-lg cursor-pointer">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>


<!-- MODAL DE CREAR O EDITAR PRODUCTO -->
<div id="modal-producto" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">

    <div
        class="bg-white rounded-xl shadow-2xl w-full max-h-[90vh] max-w-[1200px] overflow-y-auto transform transition-all ">
        <div class="sticky top-0 bg-white border-b border-gray-100 px-8 py-6 flex justify-between items-center z-10">
            <div>
                <h2 id="titulo-modal-producto" class="font-editorial text-3xl italic text-fashion-black">
                    Nuevo Producto
                </h2>
                <p class="text-gray-500 text-sm mt-1">Completa los detalles del producto</p>
            </div>
            <button onclick="abrirCerrarModalCrearProducto()"
                class="text-gray-400 hover:text-fashion-black transition-colors p-2 hover:bg-gray-100 rounded-full cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>
        <form id="formulario-producto" action="../../modelos/producto/crear-producto.php" method="POST" class="p-8"
            enctype="multipart/form-data">
            <input type="hidden" name="ruta-actual" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <input type="hidden" name="id" id="id-producto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-8">
                <div class="flex flex-col space-y-2">
                    <label class="block text-xs uppercase tracking-widest font-bold text-gray-500 ">
                        Imagen del Producto
                    </label>
                    <div id="zona-drop" class="relative w-full cursor-pointer group" style="padding-bottom: 100%;">
                        <input type="file" id="imagen-producto" name="imagen" accept="image/*" class="opacity-0"
                            required>
                        <div id="contenedor-previsualizacion-imagen"
                            class="absolute inset-0 bg-gray-50 rounded-lg border-2 border-gray-200 flex items-center justify-center overflow-hidden transition-all ">
                            <div id="placeholder-subida" class="text-center space-y-4">
                                <div
                                    class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-md mx-auto group-hover:scale-110 transition-transform">
                                    <i
                                        class="ph ph-upload-simple text-4xl text-gray-400 group-hover:text-fashion-black"></i>
                                </div>
                                <div>
                                    <p class="text-base font-bold text-fashion-black">Selecciona una imagen
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2 uppercase tracking-wide">JPG, PNG, WEBP</p>
                                </div>
                            </div>
                            <img id="previsualizacion-imagen" src="#" alt="Vista previa"
                                class="hidden absolute inset-0 w-full h-full object-cover z-10">
                            <div id="capa-cambio-imagen"
                                class="hidden absolute inset-0 bg-black/20 items-center justify-center group-hover:flex z-20">
                            </div>
                        </div>
                    </div>
                </div>
                <!--Datos del producto-->
                <div class="flex flex-col gap-6 relative z-30 pointer-events-auto">
                    <div class="space-y-2">
                        <label for="nombre-producto"
                            class="block text-xs uppercase tracking-widest font-bold text-gray-500">Nombre del
                            Producto</label>
                        <input type="text" id="nombre-producto" name="nombre" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-fashion-black focus:ring-0 transition-all text-fashion-black font-medium"
                            placeholder="Ej: Lampara de salón">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="precio-producto"
                                class="block text-xs uppercase tracking-widest font-bold text-gray-500">Precio
                                (€)</label>
                            <div
                                class="flex items-center bg-gray-50 border border-gray-200 rounded-lg overflow-hidden focus-within:border-fashion-black transition-colors">
                                <button type="button"
                                    class="p-2  text-gray-500 border-r border-gray-100 cursor-pointer">
                                    <i class="ph ph-minus text-md pl-2"></i>
                                </button>
                                <input type="number" id="precio-producto" name="precio" required step="0.50" min="0"
                                    value="0.00"
                                    class="w-full bg-transparent text-center tracking-wider border-none px-4 py-3 focus:ring-0 text-fashion-black font-bold appearance-none ">
                                <button type="button" class="p-2  text-gray-500 cursor-pointer">
                                    <i class="ph ph-plus text-md pr-2"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="descuento-producto"
                                class="block text-xs uppercase tracking-widest font-bold text-gray-500">Descuento
                                (%)</label>
                            <div
                                class="flex items-center bg-gray-50 border border-gray-200 rounded-lg overflow-hidden focus-within:border-fashion-black transition-colors">
                                <input type="number" id="descuento-producto" name="descuento" value="0" min="0"
                                    max="100" step="1"
                                    class="w-full bg-transparent border-none pl-4 pr-2 py-3 px-3 focus:ring-0 text-fashion-black font-bold appearance-none">
                                <div
                                    class="flex border-l border-gray-200 px-3 bg-gray-100 text-gray-500 font-bold text-xs items-center justify-center">
                                    %
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="space-y-2">
                            <label for="stock-producto"
                                class="block text-xs uppercase tracking-widest font-bold text-gray-500">Stock
                                Total</label>
                            <input type="number" id="stock-producto" name="stock" value="0" min="0" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-fashion-black focus:ring-0 transition-all text-fashion-black font-bold appearance-none">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="categoria-producto"
                            class="block text-xs uppercase tracking-widest font-bold text-gray-500">
                            Categoría
                        </label>
                        <select id="categoria-producto" name="categoria_id" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-fashion-black focus:ring-0 transition-all text-fashion-black cursor-pointer">
                            <option value="">Seleccionar Categoría</option>
                            <?php
                            foreach ($categorias as $categoria):
                                ?>
                                <option value="<?= $categoria['id'] ?>">
                                    <?= $categoria['nombre'] ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="descripcion-producto"
                            class="block text-xs uppercase tracking-widest font-bold text-gray-500">
                            Descripción del Producto
                        </label>
                        <textarea id="descripcion-producto" name="descripcion" rows="6"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:border-fashion-black focus:ring-0 transition-all resize-none text-fashion-black"
                            placeholder="Describe los detalles, materiales, y cuidados del producto..."></textarea>
                    </div>

                </div>

            </div>
            <div class="flex gap-4 pt-6 border-t border-gray-100">
                <button type="button" onclick="abrirCerrarModalCrearProducto()"
                    class="flex-1 bg-gray-200 text-gray-700 py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all rounded-lg cursor-pointer">
                    Cancelar
                </button>
                <button type="submit"
                    class="flex-1 bg-fashion-black text-white py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all rounded-lg cursor-pointer">
                    Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>


<!--MODAL CREAR Y EDITAR CATEGORIAS-->

<div id="modal-categoria" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">

        <div class="sticky top-0 bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
            <h2 id="titulo-modal-categoria" class="font-editorial text-3xl italic text-fashion-black">Nueva Categoría
            </h2>
            <button onclick="abrirCerrarModalCrearCategoria()"
                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>
        <form id="formulario-categoria" action="../modelos/categorias/crear-categoria.php" method="POST" class="p-8">
            <input type="hidden" name="ruta-actual" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <input type="hidden" name="id" id="id-categoria">
            <div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre-categoria" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>

                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Descripción</label>
                    <textarea name="descripcion" id="descripcion-categoria" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black"></textarea>
                </div>


                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Categoría Padre</label>
                    <select name="categoria_padre_id" id="id-padre-categoria"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black bg-white">
                        <option value="">Ninguna (Categoría Principal)</option>

                    </select>
                </div>
            </div>
            <div class="flex gap-4 mt-8">
                <button onclick="abrirCerrarModalCrearCategoria()" type="button"
                    class="flex-1 bg-gray-200 text-gray-700 py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all rounded-lg cursor-pointer">
                    Cancelar
                </button>
                <button type="submit"
                    class="flex-1 bg-fashion-black text-white py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all rounded-lg shadow-lg cursor-pointer">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>


<!--MODAL CREAR Y EDITAR PEDIDOS-->
<div id="modal-pedido" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-gray-200 px-8 py-6 flex justify-between items-center">
            <h2 id="titulo-modal-pedido" class="font-editorial text-3xl italic text-fashion-black">Nuevo Pedido</h2>
            <button onclick="abrirCerrarModalCrearPedido()"
                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer">
                <i class="ph ph-x text-2xl"></i>
            </button>
        </div>
        <form id="formulario-pedido" action="../../modelos/pedido/crear-pedido.php" method="POST" class="p-8">
            <input type="hidden" name="category_id" id="id-formulario-pedido">
            <input type="hidden" name="ruta-actual" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Email Usuario</label>
                    <input type="email" name="usuario_email" id="email-usuario-pedido" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black"
                        placeholder="Email del cliente">
                </div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Coste Total (€)</label>
                    <input type="number" step="0.01" name="coste_total" id="coste-total-pedido" required readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:border-fashion-black font-bold">
                </div>
                <div class="md:col-span-2 mt-4">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-xs uppercase tracking-widest font-bold text-gray-500">Artículos del Pedido</h4>
                        <button type="button" id="agregar-producto-pedido"
                            class="text-xs bg-fashion-black text-white px-4 py-2 rounded hover:bg-fashion-accent transition-colors flex items-center gap-2">
                            <i class="ph ph-plus"></i> Añadir Producto
                        </button>
                    </div>
                    <div class="overflow-x-auto border border-gray-100 rounded-lg">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500">
                                        Producto</th>
                                    <th
                                        class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500 w-24">
                                        Cant.</th>
                                    <th
                                        class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500 text-right w-24">
                                        Precio</th>
                                    <th
                                        class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500 text-right w-24">
                                        Subtotal</th>
                                    <th
                                        class="px-4 py-3 text-[10px] uppercase tracking-widest font-bold text-gray-500 text-center w-12">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="constructor-items-pedido" class="divide-y divide-gray-100">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Nombre
                        Destinatario</label>
                    <input type="text" name="nombre_destinatario" id="nombre-destinatario-pedido" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Dirección Envío</label>
                    <textarea name="direccion_envio" id="direccion-envio-pedido" required rows="2"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black"></textarea>
                </div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad-pedido" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>
                <div class="space-y-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Provincia</label>
                    <input type="text" name="provincia" id="provincia-pedido" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs uppercase tracking-widest font-semibold text-gray-700">Estado</label>
                    <select name="estado" id="estado-pedido" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-fashion-black bg-white">
                        <option value="pendiente">Pendiente</option>
                        <option value="pagado">Pagado</option>
                        <option value="enviado">Enviado</option>
                        <option value="entregado">Entregado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>

            </div>
            <div class="flex gap-4 mt-8">
                <button onclick="abrirCerrarModalCrearPedido()" type="button"
                    class="flex-1 bg-gray-200 text-gray-700 py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-gray-300 transition-all rounded-lg cursor-pointer">
                    Cancelar
                </button>
                <button type="submit"
                    class="flex-1 bg-fashion-black text-white py-4 px-8 text-xs uppercase tracking-[0.25em] font-semibold hover:bg-fashion-accent transition-all rounded-lg shadow-lg cursor-pointer">
                    Guardar Pedido
                </button>
            </div>
        </form>
    </div>
</div>



<!-- MODAL DE RESULTADO -->
<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="resultado-modal fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">

        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 text-center transform transition-all">

            <!-- CÍRCULO DEL ICONO -->
            <?php if ($_SESSION['mensaje']['estado'] == true): ?>
                <div class="mb-6 w-16 h-16 bg-green-100 text-green-600 flex items-center justify-center rounded-full mx-auto">
                    <i class="ph ph-check text-3xl"></i>
                </div>
            <?php else: ?>
                <div class="mb-6 w-16 h-16 bg-red-100 text-red-600 flex items-center justify-center rounded-full mx-auto">
                    <i class="ph ph-x text-3xl"></i>
                </div>
            <?php endif; ?>

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
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>