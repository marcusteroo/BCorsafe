<?php
include_once __DIR__ . '/../Model/PedidoDAO.php';
include_once 'BaseController.php';
class AdminController extends BaseController {
    public function adminPage() {
        $titulo = "Admin";
        $vista = "web/View/panel-admin.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    public function adminPage3Pedidos() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $titulo = "Ultimos 3 Pedidos";
        $vista = "web/View/admin-page3Pedidos.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    // Obtener todos los pedidos
    public function obtenerTodosLosPedidos() {
        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->obtenerTodos(); // Método para obtener todos los pedidos

        echo json_encode([
            'estado' => 'Exito',
            'data' => $pedidos
        ]);
    }

    // Eliminar un pedido
    public function eliminarPedido($id_pedido) {
        if (!$id_pedido) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'ID de pedido no proporcionado'
            ]);
            return;
        }

        $pedidoDAO = new PedidoDAO();
        $pedidoDAO->eliminarPedido($id_pedido); // Método para eliminar pedido

        echo json_encode([
            'estado' => 'Exito',
            'mensaje' => 'Pedido eliminado correctamente'
        ]);
    }

    // Esta funcion la estoy haciendo para utilizar arrays en una SESION (Peticion de David)
    public function mostrar3ultimosPedidos($id_usuario) {
        if (!$id_usuario) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'ID de usuario no proporcionado'
            ]);
            return;
        }

        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->obtenerPedidosCompletadosYUltimos();

        // Guardar en sesión
        $_SESSION['ultimos_pedidos'] = $pedidos;

        echo json_encode([
            'estado' => 'Exito',
            'data' => $pedidos
        ]);
    }
}
?>
