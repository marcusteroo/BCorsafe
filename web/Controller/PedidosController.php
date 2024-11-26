<?php
include_once 'web/Model/PedidoDAO.php';
include_once 'web/Model/DetallePedidoDAO.php';
include_once 'web/Model/ProductoDAO.php';
class PedidosController {
    //Esta es una de las funciones mas complejas que tengo, lo que hace es agregar el producto al carrito con sus correspoondientes ingredientes que ha selecionado el usuario, utilizo un array_unique para eliminar los ingredientes duplicados luego convierto esta array en una cadena de texo separada por una coma para insertalo de manera mas ordenada a la base de datos, luego obtengo el pedido luego lo creo, después de hacer eso obtengo los ingredientes de ese producto para compararlos con los que el usuario ha seleccionado para ver que si uno no esta seleccionado se le restan 2€ al precio total.
    public function agregarAlCarrito() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } 
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $id_usuario = $_SESSION['usuario_id'];
        $id_producto = $_POST['id_producto'];
        $ingredientes_custom = isset($_POST['ingredientes_custom']) ? $_POST['ingredientes_custom'] : [];
        $cantidad = $_POST['cantidad'] ?? 1;
    
        $ingredientes_custom = array_unique($ingredientes_custom);
    
        $ingredientes_custom_str = implode(',', $ingredientes_custom);
    
        $pedidoDAO = new PedidoDAO();     
        $detallePedidoDAO = new DetallePedidoDAO();
        $productoDAO = new ProductoDAO();
    
        $pedido = $pedidoDAO->obtenerPedidoEnProceso($id_usuario);
        if (!$pedido) {
            $pedido = $pedidoDAO->crearPedido($id_usuario);
        }
    
        $producto = $productoDAO->getProductoById($id_producto);
    
        $ingredientes_totales = $productoDAO->getIngredientesByProductoId($id_producto);
    
        $ingredientes_nombres = array_map(function($ingrediente) {
            return $ingrediente->nombre_ingrediente;
        }, $ingredientes_totales);
    
        $precio_final = $producto->precio;
        
        if (!empty($ingredientes_custom)) {
            foreach ($ingredientes_nombres as $ingrediente) {
                if (!in_array($ingrediente, $ingredientes_custom)) {
                    $precio_final -= 2;
                }
            }
        }
    
        $detallePedidoDAO->agregarDetalle(
            $pedido->id_pedido,
            $id_producto,
            $cantidad,
            $precio_final,
            $ingredientes_custom_str
        );
    
        header("Location: /BCorsafe/pedidos/verCarrito");
        exit();
    }
    

    public function verCarrito() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } 
        $id_usuario = $_SESSION['usuario_id'];
        $productoDAO = new ProductoDAO();
        $pedidoDAO = new PedidoDAO();
        $detallePedidoDAO = new DetallePedidoDAO();

        // Obtener el pedido en proceso
        $pedido = $pedidoDAO->obtenerPedidoEnProceso($id_usuario);
        if (!$pedido) {
            $detalles = [];
        } else {
            $detalles = $detallePedidoDAO->obtenerDetallesPorPedido($pedido->id_pedido);
        }

        $titulo = "Carrito de Compras";
        $vista = "web/View/carrito.php";
        include_once("web/View/main/main.php");
    }
}
?>
