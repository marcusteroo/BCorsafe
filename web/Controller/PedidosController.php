<?php
include_once 'web/Model/PedidoDAO.php';
include_once 'web/Model/DetallePedidoDAO.php';
include_once 'web/Model/ProductoDAO.php';
include_once 'web/Model/MetodoPagoDAO.php';
include_once 'BaseController.php';
class PedidosController extends BaseController {
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
            $ingredientes_finales = [];
            foreach ($ingredientes_nombres as $ingrediente) {
                if (in_array($ingrediente, $ingredientes_custom)) {
                    $ingredientes_finales[] = $ingrediente;
                } else {
                    $precio_final -= 2;
                }
            }
        } else {
            $ingredientes_finales = [];
        }
        
        $ingredientes_custom_str = implode(',', $ingredientes_finales);
    
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
    public function quitarProducto() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } 
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $id_detalle = $_GET['id'];
        $detallePedidoDAO = new DetallePedidoDAO();
    
        $detallePedidoDAO->eliminarDetalle($id_detalle);
    
        header("Location: /BCorsafe/pedidos/verCarrito");
        exit();
    }
    public function editarProducto() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $id_detalle = $_POST['id_detalle']; 
        $detallePedidoDAO = new DetallePedidoDAO();
        $productoDAO = new ProductoDAO();
        $detalle_edit = $detallePedidoDAO->obtenerPorId($id_detalle);
        $id_producto_edit = $detalle_edit->id_producto;
        $producto_edit = $productoDAO->getProductoById($id_producto_edit);
        $ingredientes_totales = $productoDAO->getIngredientesByProductoId($detalle_edit->id_producto);
        $ingredientes_seleccionados = explode(',', $detalle_edit->ingredientes_custom);
    
        $titulo = "Editar Producto en el Carrito";
        $vista = "web/View/producto_detalle_edit.php"; 
        include_once("web/View/main/main.php");
    }
    public function actualizarCarrito() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $id_detalle = $_POST['id_detalle'];
        $cantidad = $_POST['cantidad'];
        $ingredientes_custom = isset($_POST['ingredientes_custom']) ? $_POST['ingredientes_custom'] : [];
        $ingredientes_custom = array_unique($ingredientes_custom);
        $ingredientes_custom_str = implode(',', $ingredientes_custom);
    
        $detallePedidoDAO = new DetallePedidoDAO();
        $detalle = $detallePedidoDAO->obtenerPorId($id_detalle);
        
        $productoDAO = new ProductoDAO();
        $producto = $productoDAO->getProductoById($detalle->id_producto);
        
        if (!$producto) {
            echo "Producto no encontrado";
            exit();
        }
    
        $productoDAO = new ProductoDAO();
        $ingredientes_producto = $productoDAO->getIngredientesByProductoId($producto->id_producto);
    
        $precio_final = $producto->precio;
        foreach ($ingredientes_producto as $ingrediente) {
            if (!in_array($ingrediente->nombre_ingrediente, $ingredientes_custom)) {
                $precio_final -= 2;  
            }
        }
    
        $detallePedidoDAO->actualizarDetalle($id_detalle, $cantidad, $precio_final, $ingredientes_custom_str);
    
        header("Location: /BCorsafe/pedidos/verCarrito");
        exit();
    }
    public function PedidoCompra() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $detallePedidoDAO = new DetallePedidoDAO();
        $productoDAO = new ProductoDAO(); // Asegúrate de tener acceso a los productos
        $metodoPagoDAO = new MetodoPagoDAO();
        $id_usuario = $_SESSION['usuario_id'];
        $metodos_pago = $metodoPagoDAO->obtenerMetodosPorUsuario($id_usuario);
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->obtenerPorId($id_usuario);
        $pedidoDAO = new PedidoDAO();
        $pedido = $pedidoDAO->obtenerPorId($id_usuario);
        $pedidos = $pedidoDAO->obtenerPedidoEnProceso($id_usuario);
        
        if (!$pedidos) {
            $detalles = [];
        } else {
            // Obtener los detalles del pedido
            $detalles = $detallePedidoDAO->obtenerDetallesPorPedido($pedidos->id_pedido);
            
            // Agregar información del producto a cada detalle
            foreach ($detalles as $detalle) {
                $producto = $productoDAO->obtenerPorId($detalle->id_producto); // Obtener los datos del producto
                $detalle->producto = $producto; // Añadir el objeto producto al detalle
            }
        }
    
        $titulo = "Finalizar Compra";
        $vista = "web/View/pagina-compra.php";
        include_once("web/View/main/main.php");
    }
    
    
    
}
?>
