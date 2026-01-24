<?php
session_start();
require_once __DIR__ . '/../../config/ruta.php';
$rutaRaiz = ruta_raiz();
$rutaWeb = ruta_web();

require_once $rutaRaiz . '/config/seguridad.php';
restringirAccesoClientes();

$titulo = "Panel de administrador";
require_once $rutaRaiz . '/src/plantillas/cabecera.php';

require_once $rutaRaiz . '/modelos/usuario/mostrar-usuarios.php';
require_once $rutaRaiz . '/modelos/producto/mostrar-productos.php';
require_once $rutaRaiz . '/modelos/categoria/mostrar-categoria.php';
require_once $rutaRaiz . '/modelos/pedido/mostrar-pedidos.php';
require_once $rutaRaiz . '/modelos/pedido/mostrar-detalles-pedido.php';
require_once $rutaRaiz . '/modelos/informes/obtener-informe.php';


$filtroBusquedaProducto = $_GET['busquedaProducto'] ?? '';
$filtroOrdenProductos = $_GET['ordenProductos'] ?? '';
$filtroBusquedaCategoria = $_GET['busquedaCategoria'] ?? '';
$filtroOrdenCategorias = $_GET['ordenCategorias'] ?? '';
$filtroBusquedaPedido = $_GET['busquedaPedido'] ?? '';
$filtroOrdenPedidos = $_GET['ordenPedidos'] ?? '';
$filtroBusquedaUsuario = $_GET['busquedaUsuario'] ?? '';
$filtroOrdenUsuario = $_GET['ordenUsuario'] ?? '';

$usuarios = mostrarUsuarios($filtroBusquedaUsuario, $filtroBusquedaUsuario, $filtroBusquedaUsuario, $filtroOrdenUsuario);
$productos = mostrarProductos($filtroBusquedaProducto, $filtroOrdenProductos, "", null, 0, false);
$categorias = mostrarCategorias($filtroBusquedaCategoria, $filtroOrdenCategorias);
$pedidos = mostrarPedidos('', $filtroBusquedaPedido, $filtroOrdenPedidos);
$ingresosMensuales = obtenerIngresosMensuales();
$productosMasVendidos = obtenerProductosMasVendidos();


?>

<main class="min-h-screen bg-fashion-gray flex flex-col lg:flex-row">

    <aside
        class="w-full lg:w-96 bg-white shadow-xl  md:block sticky top-24 lg:h-[calc(100vh-6rem)] z-10 overflow-y-auto p-6">
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
            <?php if ($_SESSION['usuario']['rol'] == 'admin'): ?>
                <li onclick="mostrarSeccion('informes')"
                    class="nav-item w-full text-left px-4 py-6 rounded-lg text-sm uppercase tracking-widest font-semibold text-gray-500 hover:bg-fashion-gray hover:text-fashion-black transition-colors flex items-center">
                    <i class="ph ph-chart-line-up mr-2 text-xl"></i>Informes
                </li>
            <?php endif; ?>
        </nav>
    </aside>

    <section class="flex-1 p-8 pt-24" id="apartadoActual" data-seccion-Actual="dashboard">
        <!--SECCIÓN DASHBOARD-->
        <div id="seccion-dashboard" class="seccion-panel">
            <h2 class="font-titulos text-3xl font-bold text-fashion-black mb-8">Resumen General</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">Categorías</p>
                        <h3 class="text-2xl font-bold text-fashion-black">
                            <?php
                            $totalCategorias = 0;
                            foreach ($categorias as $categoria) {
                                $totalCategorias++;
                            }
                            echo $totalCategorias;
                            ?>
                        </h3>
                    </div>
                    <div class="p-2 bg-green-100 rounded-xl text-green-600">
                        <i class="ph ph-tag text-xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 mb-1">Pedidos</p>
                        <h3 class="text-2xl font-bold text-fashion-black">
                            <?php
                            $totalPedidos = 0;
                            foreach ($pedidos as $pedido) {
                                $totalPedidos++;
                            }
                            echo $totalPedidos;
                            ?>
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
                            <?php
                            $totalUsuarios = 0;
                            foreach ($usuarios as $usuario) {
                                $totalUsuarios++;
                            }
                            echo $totalUsuarios;
                            ?>
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
                            <?php
                            $totalProductos = 0;
                            foreach ($productos as $producto) {
                                $totalProductos++;
                            }
                            echo $totalProductos;
                            ?>
                        </h3>
                    </div>
                    <div class="p-2 bg-orange-100 rounded-xl text-orange-600">
                        <i class="ph ph-lamp text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!--SECCIÓN PEDIDOS-->
        <div id="seccion-pedidos" class="seccion-panel">
            <div class="flex justify-between items-center mb-8 flex-col lg:flex-row">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Pedidos</h2>
                <button onclick="abrirCerrarModalCrearPedido(null,'crear')"
                    class="bg-fashion-black text-white px-6 py-3 w-full lg:w-auto mt-8 lg:mt-0 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-lg cursor-pointer">
                    <i class="ph ph-plus mr-2"></i>Nuevo Pedido
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto flex-col lg:flex-row">
                <div
                    class="px-6 py-4 bg-gray-50 flex gap-4 items-center border-b border-gray-200  flex-col lg:flex-row ">
                    <div class="relative flex-1">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="busqueda-pedidos" placeholder="Buscar por nombre, descripción o ID..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-fashion-black outline-none transition-all">
                    </div>
                    <button id="botonFiltrarPedidos"
                        class="<?php echo $filtroBusquedaPedido ? 'bg-gray-400' : 'bg-fashion-black' ?> text-white px-6 py-2 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-sm cursor-pointer flex items-center gap-2">
                        <i class="ph ph-search"></i>
                        <?php echo $filtroBusquedaPedido ? 'Limpiar' : 'Buscar' ?>
                    </button>
                    <div>
                        <select id="barraOrdenPedidos" class="w-full lg:w-auto mt-4 lg:mt-0">
                            <option value="">Ordenar por</option>
                            <option value="precio_asc">Precio Ascendente</option>
                            <option value="precio_desc">Precio Descendente</option>
                            <option value="Alfabético_asc">Alfabeticamente A-Z</option>
                            <option value="Alfabético_desc">Alfabeticamente Z-A</option>
                        </select>
                    </div>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>

                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th
                                class="hidden lg:table-cell lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                ID
                            </th>
                            <th class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Cliente
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Fecha
                            </th>
                            <th class="lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Total
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 lg:py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado
                            </th>
                            <th
                                class="lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if ($pedidos): ?>
                            <?php foreach ($pedidos as $pedido): ?>
                                <!--Se saca el email del usuario-->
                                <?php foreach ($usuarios as $usuario) {
                                    if ($usuario['id'] == $pedido['usuario_id']) {
                                        $_email = $usuario['email'];
                                    }
                                } ?>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <td class="hidden lg:table-cell lg:px-6 lg:py-4 font-bold text-fashion-black">
                                        <?= htmlspecialchars($pedido['id'] ?? '') ?>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4">
                                        <div class="text-xs lg:text-sm font-semibold text-fashion-black">
                                            <?= htmlspecialchars($pedido['nombre_destinatario'] ?? '') ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?= htmlspecialchars($_email) ?>
                                        </div>

                                    </td>
                                    <td class="hidden lg:table-cell lg:px-6 py-4 text-sm text-gray-500">
                                        <?= htmlspecialchars($pedido['fecha'] ?? '') ?>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4 text-sm font-bold text-fashion-black">
                                        <?= htmlspecialchars($pedido['coste_total'] ?? '') ?>€
                                    </td>
                                    <td class="hidden lg:table-cell lg:px-6 py-4">
                                        <?php $coloresEstado = [
                                            'pendiente' => 'bg-yellow-100 text-yellow-700',
                                            'pagado' => 'bg-green-100 text-green-700',
                                            'enviado' => 'bg-blue-100 text-blue-700',
                                            'entregado' => 'bg-purple-100 text-purple-700',
                                            'cancelado' => 'bg-red-100 text-red-700'
                                        ][$pedido['estado']] ?? 'bg-gray-100 text-gray-700' ?>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?php echo $coloresEstado; ?>">
                                            <?= htmlspecialchars($pedido['estado'] ?? '') ?>
                                        </span>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4 text-right">
                                        <div class="flex flex-col lg:flex-row items-center justify-end gap-4 lg:gap-2">
                                            <button
                                                onclick="cerrarModalDetallesPedido('<?= htmlspecialchars($pedido['id'] ?? '') ?>')"
                                                class="text-gray-400 hover:text-fashion-accent transition-colors cursor-pointer"
                                                title="Ver Detalles">
                                                <i class="ph ph-eye text-xl"></i>
                                            </button>
                                            <button <?php
                                            $emailPedido = "";
                                            foreach ($usuarios as $usuario) {
                                                if ($usuario['id'] == $pedido['usuario_id']) {
                                                    $emailPedido = $usuario['email'];
                                                }
                                            }
                                            $productosPedido = [];
                                            $pedidoDetalles = mostrarDetallesPedido($pedido['id'] ?? '');
                                            foreach ($pedidoDetalles as $detalle) {
                                                foreach ($productos as $producto) {
                                                    if ($producto['id'] == $detalle['producto_id']) {
                                                        $productosPedido[] = array_merge($detalle, $producto);
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>
                                                data-productos='<?= json_encode($productosPedido) ?>'
                                                onclick="abrirCerrarModalCrearPedido(this,'editar', '<?= $_SESSION['usuario']['rol'] ?>', '<?= $emailPedido ?>', '<?= $pedido['coste_total'] ?>','<?= htmlspecialchars($pedido['nombre_destinatario'], ENT_QUOTES) ?>','<?= htmlspecialchars($pedido['direccion_envio'], ENT_QUOTES) ?>','<?= htmlspecialchars($pedido['ciudad'], ENT_QUOTES) ?>','<?= htmlspecialchars($pedido['provincia'], ENT_QUOTES) ?>','<?= htmlspecialchars($pedido['estado'], ENT_QUOTES) ?>','<?= $pedido['id'] ?>')"
                                                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                                title="Editar">
                                                <i class="ph ph-pencil-simple text-xl"></i>
                                            </button>
                                            <?php if ($_SESSION['usuario']['rol'] == 'admin'): ?>
                                                <?php if ($pedido['estado'] !== 'cancelado'): ?>
                                                    <button onclick="abrirModalConfirmarEliminar('pedido', <?= $pedido['id'] ?>)"
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
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay pedidos</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECCIÓN USUARIOS-->
        <div id="seccion-usuarios" class="seccion-panel">
            <div class="flex justify-between items-center mb-8 flex-col lg:flex-row">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Usuarios</h2>
                <button onclick="abrirCerrarModalCrearUsuario('crear', '<?= $_SESSION['usuario']['rol'] ?>')" class=" bg-fashion-black text-white px-6 py-3 rounded-lg text-xs uppercase tracking-widest
                    font-semibold hover:bg-fashion-accent transition-colors shadow-lg cursor-pointer">
                    <i class="ph ph-plus mr-2"></i>Nuevo Usuario
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto flex-col lg:flex-row">
                <div class="px-6 py-4 bg-gray-50 flex gap-4 items-center border-b border-gray-200 flex-col lg:flex-row">
                    <div class="relative flex-1 w-full lg:w-auto">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="busqueda-usuario" placeholder="Buscar por nombre, email..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-fashion-black outline-none transition-all">
                    </div>
                    <button id="botonFiltrarUsuario"
                        class="w-full lg:w-auto mt-4 lg:mt-0 <?php echo $filtroBusquedaUsuario ? 'bg-gray-400' : 'bg-fashion-black' ?> text-white px-6 py-2 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-sm cursor-pointer flex items-center justify-center gap-2">
                        <i class="ph ph-search"></i>
                        <?php echo $filtroBusquedaUsuario ? 'Limpiar' : 'Buscar' ?>
                    </button>
                    <div class="w-full lg:w-auto">
                        <select id="barraOrdenUsuario" class="w-full lg:w-auto mt-4 lg:mt-0">
                            <option value="">Ordenar por</option>
                            <option value="Alfabético_asc">Alfabeticamente A-Z</option>
                            <option value="Alfabético_desc">Alfabeticamente Z-A</option>
                        </select>
                    </div>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Usuario</th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Rol
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado</th>
                            <th
                                class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if ($usuarios): ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <?php ?>
                                <tr
                                    class="
                                <?php echo $_SESSION['usuario']['rol'] == 'empleado' && $usuario['rol'] != 'cliente' && $_SESSION['usuario']['nombre'] != $usuario['nombre'] ? 'hidden' : '' ?> hover:bg-gray-50 transition-colors">
                                    <td class="px-2 lg:px-6 py-4 flex flex-col items-start fila-usuario">
                                        <strong class="text-xs lg:text-base">
                                            <?= htmlspecialchars($usuario['nombre'] ?? '') ?>
                                        </strong>
                                        <span
                                            class="text-[10px] lg:text-sm text-gray-500"><?= htmlspecialchars($usuario['email'] ?? '') ?></span>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider bg-gray-100 text-gray-800">
                                            <?= htmlspecialchars($usuario['rol'] ?? '') ?>
                                        </span>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?php echo $usuario['activo'] == 1 ? "bg-green-100 text-green-700" : "bg-red-100 text-red-700" ?>">
                                            <?php echo $usuario['activo'] == 1 ? 'activo' : 'inactivo' ?>
                                        </span>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4 text-right space-x-2">
                                        <div class="flex flex-col lg:flex-row items-center justify-end gap-4 lg:gap-2">
                                            <?php if ($_SESSION['usuario']['rol'] == 'admin' || ($_SESSION['usuario']['rol'] == 'empleado' && $usuario['rol'] == 'cliente') || ($_SESSION['usuario']['nombre'] == $usuario['nombre'])): ?>
                                                <button
                                                    onclick="abrirCerrarModalCrearUsuario('editar','<?= $_SESSION['usuario']['rol'] ?>', '<?= htmlspecialchars($usuario['nombre'], ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['apellidos'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['email'], ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['rol'], ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['telefono'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['direccion'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['activo'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($usuario['id'], ENT_QUOTES) ?>')"
                                                    class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                                    title="Editar">
                                                    <i class="ph ph-pencil-simple text-xl"></i>
                                                </button>
                                            <?php endif; ?>
                                            <?php
                                            if ($usuario['activo'] == 1): ?>
                                                <button id="btnEliminarUsuario"
                                                    onclick="abrirModalConfirmarEliminar('usuario', <?= $usuario['id'] ?>)"
                                                    class=" text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
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
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay usuarios</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--SECCIÓN PRODUCTOS-->
        <div id="seccion-productos" class="seccion-panel">
            <div class="flex justify-between items-center mb-8 flex-col lg:flex-row">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Productos</h2>
                <button onclick="abrirCerrarModalCrearProducto('crear')"
                    class="bg-fashion-black text-white px-6 py-3 w-full lg:w-auto mt-8 lg:mt-0 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-lg cursor-pointer">
                    <i class="ph ph-plus mr-2"></i>Nuevo Producto
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto flex-col lg:flex-row">
                <div class="px-6 py-4 bg-gray-50 flex gap-4 items-center border-b border-gray-200 flex-col lg:flex-row">
                    <div class="relative flex-1 w-full lg:w-auto">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="busqueda-productos" placeholder="Buscar por nombre, ID..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-fashion-black outline-none transition-all">
                    </div>
                    <button id="botonFiltrarProductos"
                        class="w-full lg:w-auto mt-4 lg:mt-0 <?php echo $filtroBusquedaProducto ? 'bg-gray-400' : 'bg-fashion-black' ?> text-white px-6 py-2 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-sm cursor-pointer flex items-center justify-center gap-2">
                        <i class="ph ph-search"></i><?php echo $filtroBusquedaProducto ? 'Limpiar' : 'Buscar' ?>
                    </button>
                    <div class="w-full lg:w-auto">
                        <select id="barraOrdenProductos" class="w-full lg:w-auto mt-4 lg:mt-0">
                            <option value="">Ordenar por</option>
                            <option value="precio_asc">Precio ascendente</option>
                            <option value="precio_desc">Precio descendente</option>
                            <option value="Alfabético_asc">Alfabeticamente A-Z</option>
                            <option value="Alfabético_desc">Alfabeticamente Z-A</option>
                        </select>
                    </div>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th
                                class="hidden lg:table-cell px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 w-20">
                                Imagen</th>
                            <th class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Producto</th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 w-1/3">
                                Descripción</th>
                            <th
                                class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right lg:text-left">
                                Precio</th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Stock</th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Categoría</th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado</th>
                            <th
                                class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if ($productos): ?>
                            <?php foreach ($productos as $producto): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="hidden lg:table-cell px-2 lg:px-6 py-4">
                                        <img src="<?= $rutaWeb . '/' . $producto['imagen'] ?>" alt="Producto"
                                            class="w-12 h-12 lg:w-20 lg:h-20 object-cover rounded-md">
                                    </td>
                                    <td class="px-2 lg:px-6 py-4">
                                        <strong
                                            class="text-xs lg:text-base"><?= htmlspecialchars($producto['nombre'] ?? '') ?></strong>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <p class="text-xs text-gray-500 line-clamp-3">Descripcion de producto</p>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4 text-right lg:text-left">
                                        <span class="font-bold text-fashion-black text-xs lg:text-base">
                                            <?= $producto['precio'] ?? '' ?>€
                                        </span>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
                                            <?= $producto['stock'] ?? '' ?>
                                        </span>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <p class="text-sm text-gray-500"><?= $producto['categoria_id'] ?></p>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?php echo $producto['activo'] == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                            <?= $producto['activo'] == 1 ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4 text-right">
                                        <div class="flex flex-col lg:flex-row items-center justify-end gap-4 lg:gap-2">
                                            <button
                                                onclick="abrirCerrarModalCrearProducto('editar', '<?= htmlspecialchars($producto['nombre'], ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['descripcion'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['precio'], ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['stock'], ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['imagen'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['descuento'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['categoria_id'], ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['id'], ENT_QUOTES) ?>', '<?= htmlspecialchars($producto['categoria_id'], ENT_QUOTES) ?>')"
                                                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                                title="Editar">
                                                <i class="ph ph-pencil-simple text-xl"></i>
                                            </button>
                                            <?php if ($producto['activo'] == 1): ?>
                                                <button onclick="abrirModalConfirmarEliminar('producto', <?= $producto['id'] ?>)"
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
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">No hay productos</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!--SECCIÓN CATEGORIAS-->
        <div id="seccion-categorias" class="seccion-panel ">
            <div class="flex justify-between items-center mb-8 flex-col lg:flex-row">
                <h2 class="font-titulos text-3xl font-bold text-fashion-black">Gestión de Categorías</h2>
                <button onclick="abrirCerrarModalCrearCategoria('crear')"
                    class="bg-fashion-black text-white px-6 py-3 w-full lg:w-auto mt-8 lg:mt-0 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-lg cursor-pointer">
                    <i class="ph ph-plus mr-2"></i>Nueva Categoría
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden overflow-x-auto flex-col lg:flex-row">
                <div class="px-6 py-4 bg-gray-50 flex gap-4 items-center border-b border-gray-200 flex-col lg:flex-row">
                    <div class="relative flex-1 w-full lg:w-auto">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="busqueda-categorias" placeholder="Buscar por nombre, ID..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-fashion-black outline-none transition-all">
                    </div>
                    <button id="botonFiltrarCategorias"
                        class="w-full lg:w-auto mt-4 lg:mt-0 <?php echo $filtroBusquedaCategoria ? 'bg-gray-400' : 'bg-fashion-black' ?> text-white px-6 py-2 rounded-lg text-xs uppercase tracking-widest font-semibold hover:bg-fashion-accent transition-colors shadow-sm cursor-pointer flex items-center justify-center gap-2">
                        <i class="ph ph-search"></i><?php echo $filtroBusquedaCategoria ? 'Limpiar' : 'Buscar' ?>
                    </button>
                    <div class="w-full lg:w-auto">
                        <select id="barraOrdenCategorias" class="w-full lg:w-auto mt-4 lg:mt-0">
                            <option value="">Ordenar por</option>
                            <option value="Alfabético_asc">Alfabeticamente A-Z</option>
                            <option value="Alfabético_desc">Alfabeticamente Z-A</option>
                        </select>
                    </div>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Nombre
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Descripción
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Categoría Padre
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500">
                                Estado
                            </th>
                            <th
                                class="px-2 lg:px-6 py-4 text-xs uppercase tracking-widest font-semibold text-gray-500 text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($categorias): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-2 lg:px-6 py-4">
                                        <strong class="text-xs lg:text-base"><?= $categoria['nombre'] ?? '' ?></strong>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <p class="text-xs text-gray-500 line-clamp-3"><?= $categoria['descripcion'] ?? '' ?></p>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <p class="text-xs text-gray-500 line-clamp-3">
                                            <?= $categoria['categoria_padre_id'] ?? '' ?>
                                        </p>
                                    </td>
                                    <td class="hidden lg:table-cell px-6 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider <?= $categoria['activa'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                                            <?= $categoria['activa'] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                    <td class="px-2 lg:px-6 py-4 text-right">
                                        <div class="flex flex-col lg:flex-row items-center justify-end gap-4 lg:gap-2">
                                            <button
                                                onclick="abrirCerrarModalCrearCategoria('editar', '<?= htmlspecialchars($categoria['nombre'], ENT_QUOTES) ?>', '<?= htmlspecialchars($categoria['descripcion'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($categoria['categoria_padre_id'] ?? '', ENT_QUOTES) ?>', '<?= htmlspecialchars($categoria['id'], ENT_QUOTES) ?>')"
                                                class="text-gray-400 hover:text-fashion-black transition-colors cursor-pointer"
                                                title="Editar">
                                                <i class="ph ph-pencil-simple text-xl"></i>
                                            </button>
                                            <?php if ($categoria['activa']): ?>
                                                <button onclick="abrirModalConfirmarEliminar('categoria', <?= $categoria['id'] ?>)"
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
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay categorías</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

            </div>
        </div>

        <!-- SECCIÓN INFORMES -->
        <div id="seccion-informes" class="seccion-panel">
            <h2 class="font-titulos text-3xl font-bold text-fashion-black mb-8">Informes de Análisis</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Ingresos Mensuales</h3>
                    <ul class="space-y-3">
                        <?php if (empty($ingresosMensuales)): ?>
                            <li class="text-gray-400 text-sm">No hay ingresos registrados.</li>
                        <?php else: ?>
                            <?php
                            $meses = [
                                '01' => 'Enero',
                                '02' => 'Febrero',
                                '03' => 'Marzo',
                                '04' => 'Abril',
                                '05' => 'Mayo',
                                '06' => 'Junio',
                                '07' => 'Julio',
                                '08' => 'Agosto',
                                '09' => 'Septiembre',
                                '10' => 'Octubre',
                                '11' => 'Noviembre',
                                '12' => 'Diciembre'
                            ];
                            foreach ($ingresosMensuales as $ingreso): ?>
                                <li class="flex justify-between items-center border-b border-gray-100 pb-2">
                                    <span>
                                        <?php
                                        $fechaObj = DateTime::createFromFormat('Y-m', $ingreso['mes']);
                                        echo $meses[$fechaObj->format('m')] . ' ' . $fechaObj->format('Y');
                                        ?>
                                    </span>
                                    <span class="font-bold">
                                        <?= number_format($ingreso['total'], 2) ?> €
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Productos Más Vendidos</h3>
                    <ul class="space-y-3">
                        <?php if ($productosMasVendidos): ?>
                            <?php foreach ($productosMasVendidos as $prod): ?>
                                <li class="flex justify-between items-center border-b border-gray-100 pb-2">
                                    <span>
                                        <?= htmlspecialchars($prod['nombre']) ?>
                                    </span>
                                    <span class="font-bold">
                                        <?= $prod['total_vendido'] ?> uds
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No hay productos vendidos</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold mb-4">Total de Ventas</h3>
                <span class=" text-2xl">
                    <?php
                    $totalVentas = 0;
                    if ($pedidos) {
                        foreach ($pedidos as $pedido) {
                            $totalVentas += $pedido['coste_total'];
                        }
                    }
                    echo $totalVentas;
                    ?>
                </span>
            </div>
        </div>



    </section>
    <?php include $rutaRaiz . '/src/paginas/modales-panel-administrador.php'; ?>
</main>

<script src="<?= $rutaWeb ?>/funcionalidades-js/panel-administrador.js"></script>
<?php
include $rutaRaiz . '/src/plantillas/footer.php';
?>