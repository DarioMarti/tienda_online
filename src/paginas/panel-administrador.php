<?php
$titulo = "Panel de administrador";
require '../plantillas/cabecera.php';

require '../../modelos/usuario/mostrar-usuarios.php';
require '../../modelos/producto/mostrar-productos.php';
require '../../modelos/categoria/mostrar-categoria.php';
require '../../modelos/pedido/mostrar-pedidos.php';
$usuarios = mostrarUsuarios();
$productos = mostrarProductos();
$categorias = mostrarCategorias();
$pedidos = mostrarPedidos();

?>

<main class="min-h-screen bg-fashion-gray flex">

    <aside class="w-96 bg-white shadow-xl hidden md:block sticky top-24 h-[calc(100vh-6rem)] z-10 overflow-y-auto p-6">
        <h1 class=" font-titulos  text-2xl  text-fashion-black mb-8">
            Panel de administrador
        </h1>
        <nav>
            <li onclick="mostrarSeccion('dashboard')"
                class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                <i class="ph ph-squares-four mr-2 text-xl"></i>Dashboard
            </li>
            <li onclick="mostrarSeccion('pedidos')"
                class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                <i class="ph ph-package mr-2 text-xl"></i>Pedidos
            </li>
            <li onclick="mostrarSeccion('productos')"
                class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                <i class="ph ph-t-shirt mr-2 text-xl"></i>Productos
            </li>
            <li onclick="mostrarSeccion('categorias')"
                class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                <i class="ph ph-tag mr-2 text-xl"></i>Categorías
            </li>
            <li onclick="mostrarSeccion('usuarios')"
                class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                <i class="ph ph-users mr-2 text-xl"></i>Usuarios
            </li>
            <li onclick="mostrarSeccion('informes')"
                class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                <i class="ph ph-chart-line-up mr-2 text-xl"></i>Informes
            </li>
        </nav>
    </aside>

    <section class="flex-1 p-8 pt-24" id="apartadoActual" data-seccion-Actual="dashboard">
        <!--SECCIÓN DASHBOARD-->
        <div id="seccion-dashboard" class="seccion-panel">
            <h2 class="font-titulos text-3xl font-bold text-fashion-black mb-8">Resumen General</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">Total Ventas</p>
                        <h3 class="text-2xl font-bold text-fashion-black">
                            200€
                        </h3>
                    </div>
                    <div class="p-2 bg-green-100 rounded-xl text-green-600">
                        <i class="ph ph-currency-eur text-xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">Pedidos</p>
                        <h3 class="text-2xl font-bold text-fashion-black">
                            200€
                        </h3>
                    </div>
                    <div class="p-2 bg-blue-100 rounded-xl text-blue-600">
                        <i class="ph ph-shopping-bag text-xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">Usuarios</p>
                        <h3 class="text-2xl font-bold text-fashion-black">
                            200€
                        </h3>
                    </div>
                    <div class="p-2 bg-purple-100 rounded-xl text-purple-600">
                        <i class="ph ph-users text-xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">Productos</p>
                        <h3 class="text-2xl font-bold text-fashion-black">
                            200€
                        </h3>
                    </div>
                    <div class="p-2 bg-orange-100 rounded-xl text-orange-600">
                        <i class="ph ph-tag text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!--SECCIÓN PEDIDOS-->
        <div id="seccion-pedidos" class="seccion-panel">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Pedidos</h2>
                <button
                    class="bg-fashion-black text-white px-6 py-3 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-lg">
                    <i class="ph ph-plus mr-2"></i>Nuevo Pedido
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>

                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                ID
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Cliente
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Fecha
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Total
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado
                            </th>
                            <th
                                class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <td class="px-6 py-4 font-bold text-fashion-black">
                                    <?= htmlspecialchars($pedido['id']) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-fashion-black">
                                        <?= htmlspecialchars($pedido['nombre_destinatario']) ?>
                                    </div>

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?= htmlspecialchars($pedido['fecha']) ?>
                                </td>
                                <td class="px-6 py-4 font-bold text-fashion-black">
                                    <?= htmlspecialchars($pedido['coste_total']) ?>€
                                </td>
                                <td class="px-6 py-4">
                                    <?php $coloresEstado = [
                                        'pendiente' => 'bg-yellow-100 text-yellow-700',
                                        'pagado' => 'bg-green-100 text-green-700',
                                        'enviado' => 'bg-blue-100 text-blue-700',
                                        'entregado' => 'bg-purple-100 text-purple-700',
                                        'cancelado' => 'bg-red-100 text-red-700'
                                    ][$pedido['estado']] ?? 'bg-gray-100 text-gray-700' ?>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?php echo $coloresEstado; ?>">
                                        <?= htmlspecialchars($pedido['estado']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button class="text-gray-400 hover:text-fashion-accent transition-colors cursor-pointer"
                                        title="Ver Detalles">
                                        <i class="ph ph-eye text-xl"></i>
                                    </button>
                                    <button class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                        title="Editar">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                    <?php if ($pedido['estado'] !== 'cancelado'): ?>
                                        <button onclick="eliminarPedido(<?= $pedido['id'] ?>)"
                                            class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
                                            title="Eliminar">
                                            <i class="ph ph-trash text-xl"></i>
                                        </button>
                                    <?php else: ?>
                                        <button onclick="activarPedido(<?= $pedido['id'] ?>)"
                                            class="text-gray-400 hover:text-green-500 transition-colors cursor-pointer"
                                            title="Reactivar">
                                            <i class="ph ph-arrow-u-up-left text-xl"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECCIÓN USUARIOS-->
        <div id="seccion-usuarios" class="seccion-panel">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Usuarios</h2>
                <button onclick="abrirCerrarModalCrearUsuario('crear')" class=" bg-fashion-black text-white px-6 py-3 rounded-lg text-xs uppercase tracking-widest
                    font-semibold hover:bg-fashion-accent transition-colors shadow-lg cursor-pointer">
                    <i class="ph ph-plus mr-2"></i>Nuevo Usuario
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Usuario</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Rol
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado</th>
                            <th
                                class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($usuarios as $usuario): ?>

                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 flex flex-col items-start fila-usuario">
                                    <strong>
                                        <?= htmlspecialchars($usuario['nombre']) ?>
                                    </strong>
                                    <span class="text-sm text-gray-500"><?= htmlspecialchars($usuario['email']) ?>/span>
                                </td>
                                <td>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-gray-100 text-gray-800">
                                        <?= htmlspecialchars($usuario['rol']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?php echo $usuario['activo'] == 1 ? "bg-green-100 text-green-700" : "bg-red-100 text-red-700" ?>">
                                        <?php echo $usuario['activo'] == 1 ? 'activo' : 'inactivo' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button
                                        onclick="abrirCerrarModalCrearUsuario('editar', '<?= htmlspecialchars($usuario['nombre'], ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['apellidos'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['email'], ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['rol'], ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['telefono'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['direccion'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['activo'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['id'], ENT_QUOTES) ?>')"
                                        class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                        title="Editar">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                    <?php
                                    if ($usuario['activo'] == 1): ?>
                                        <button id="btnEliminarUsuario" onclick="eliminarUsuario(<?= $usuario['id'] ?>)"
                                            class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
                                            title="Desactivar">
                                            <i class="ph ph-trash text-xl"></i>
                                        </button>

                                    <?php else: ?>
                                        <button onclick="activarUsuario(<?= $usuario['id'] ?>)"
                                            class="text-gray-400 hover:text-green-500 transition-colors cursor-pointer"
                                            title="Activar">
                                            <i class="ph ph-arrow-u-up-left text-xl"></i>
                                        </button>

                                    <?php endif ?>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--SECCIÓN PRODUCTOS-->
        <div id="seccion-productos" class="seccion-panel">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Productos</h2>
                <button
                    class="bg-fashion-black text-white px-6 py-3 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-lg">
                    <i class="ph ph-plus mr-2"></i>Nuevo Producto
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 w-20">
                                Imagen</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Producto</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 w-1/3">
                                Descripción</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Precio</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Stock</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Categoría</th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado</th>
                            <th
                                class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($productos as $producto): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <img src=<?php echo $producto['imagen'] ?> alt="Producto 1"
                                        class="w-20 h-20 object-cover">
                                </td>
                                <td class="px-6 py-4">
                                    <strong><?= htmlspecialchars($producto['nombre']) ?></strong>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs text-gray-500 line-clamp-3">Descripcion de producto</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-fashion-black">
                                        <?= $producto['precio'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
                                        <?= $producto['stock'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-500"><?= $producto['categoria_id'] ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-green-100 text-green-700">
                                        <?= $producto['activo'] == 1 ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                        title="Editar">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                    <?php if ($producto['activo'] == 1): ?>
                                        <button onclick="eliminarProducto(<?= $producto['id'] ?>)"
                                            class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
                                            title="Desactivar">
                                            <i class="ph ph-trash text-xl"></i>
                                        </button>
                                    <?php else: ?>
                                        <button onclick="activarProducto(<?= $producto['id'] ?>)"
                                            class="text-gray-400 hover:text-green-500 transition-colors cursor-pointer"
                                            title="Activar">
                                            <i class="ph ph-arrow-u-up-left text-xl"></i>
                                        </button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--SECCIÓN CATEGORIAS-->
        <div id="seccion-categorias" class="seccion-panel ">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Categorías</h2>
                <button
                    class="bg-fashion-black text-white px-6 py-3 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-lg">
                    <i class="ph ph-plus mr-2"></i>Nueva Categoría
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Nombre
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Descripción
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Categoría Padre
                            </th>
                            <th class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado
                            </th>
                            <th
                                class="px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <strong><?= $categoria['nombre'] ?></strong>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs text-gray-500 line-clamp-3"><?= $categoria['descripcion'] ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs text-gray-500 line-clamp-3">
                                        <?= $categoria['categoria_padre_id'] ?>
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?= $categoria['activa'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                                        <?= $categoria['activa'] ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                        title="Editar">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                    <?php if ($categoria['activa']): ?>
                                        <button onclick="eliminarCategoria(<?= $categoria['id'] ?>)"
                                            class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
                                            title="Desactivar">
                                            <i class="ph ph-trash text-xl"></i>
                                        </button>
                                    <?php else: ?>
                                        <button onclick="activarCategoria(<?= $categoria['id'] ?>)"
                                            class="text-gray-400 hover:text-green-500 transition-colors cursor-pointer"
                                            title="Activar">
                                            <i class="ph ph-arrow-u-up-left text-xl"></i>
                                        </button>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
        </div>

        <!--SECCIÓN PEDIDOS-->
        <div></div>
    </section>
    <?php include 'modales-panel-administrador.php'; ?>
</main>

<script src="../../funcionalidades-js/panel-administrador.js"></script>
<?php
include '../plantillas/footer.html';
?>