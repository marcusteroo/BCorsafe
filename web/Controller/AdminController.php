<?php
include_once __DIR__ . '/../Model/PedidoDAO.php';
include_once 'BaseController.php';
class AdminController extends BaseController {
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
}
?>
