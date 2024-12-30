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
        elseif ($action === 'ultimos_pedidos') {
            // Esta funcion la estoy haciendo para utilizar arrays en una SESION (Peticion de David)
            $pedidoDAO = new PedidoDAO();
            if (!isset($_SESSION['ultimos_pedidos']) || empty($_SESSION['ultimos_pedidos'])) {
                $_SESSION['ultimos_pedidos'] = $pedidoDAO->obtenerPedidosCompletadosYUltimos();
            }
            // Enviar la respuesta
            if (!empty($_SESSION['ultimos_pedidos'])) {
                echo json_encode([
                    'estado' => 'Exito',
                    'data' => $_SESSION['ultimos_pedidos']
                ]);
            } else {
                echo json_encode([
                    'estado' => 'Fallido',
                    'mensaje' => 'No hay pedidos disponibles en la sesión.'
                ]);
            }
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