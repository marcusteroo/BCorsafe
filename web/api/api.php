<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$basePath = __DIR__ . '/../..';
include_once $basePath . '/web/Model/UsuarioDAO.php';
include_once $basePath . '/web/Model/PedidoDAO.php';
include_once $basePath . '/web/Model/DetallePedidoDAO.php';
include_once $basePath . '/web/Model/ProductoDAO.php';
include_once $basePath . '/web/Controller/AdminController.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$adminController = new AdminController();

$metodo = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($metodo) {
    case 'GET':
        if ($action === 'pedidos') {
            $adminController->obtenerTodosLosPedidos();
        }
        if ($action === 'ultimos_pedidos') {
            $adminController->mostrar3ultimosPedidos();
        }
        if ($action === 'usuarios') {
            $adminController->obtenerTodosLosUsuarios();
        }
        if ($action === 'obtener_productos') {
            $adminController->obtenerTodosLosProductos();
        }
        if ($action === 'get_cupones') {
            $adminController->obtenerCupones();
        }
        break;

    case 'DELETE':
        if ($action === 'pedidos' && isset($_GET['id_pedido'])) {
            $adminController->eliminarPedido(intval($_GET['id_pedido']));
        }
        if ($action === 'usuarios' && isset($_GET['id_usuario'])) {
            $adminController->eliminarUsuario(intval($_GET['id_usuario']));
        }
        if ($action === 'eliminar_producto' && isset($_GET['id_producto'])) {
            $adminController->eliminarProducto(intval($_GET['id_producto']));
        }
        break;
    case 'POST':
        if ($action === 'add_user') {
            $adminController->anadirUsuario();
        }
        if ($action === 'add_producto') {
            $adminController->anadirProducto();
        }
        if ($action === 'editar_usuario') {
            $adminController->editarUsuarioAdmin();
        }
        if ($action === 'editar_producto') {
            $adminController->editarProducto();
        }
        if ($action === 'add_cupon') {
            $adminController->anadirCupon();
        }
        break;   
    default:
        echo json_encode([
            'estado' => 'Fallido',
            'mensaje' => 'Método o acción no soportado'
        ]);
        break;
}

?>