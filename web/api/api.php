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


$adminController = new AdminController();

$metodo = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($metodo) {
    case 'GET':
        if ($action === 'pedidos') {
            $adminController->obtenerTodosLosPedidos();
        }
        break;

    case 'DELETE': // Eliminar un pedido
        if ($action === 'pedidos' && isset($_GET['id_pedido'])) {
            $adminController->eliminarPedido(intval($_GET['id_pedido']));
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