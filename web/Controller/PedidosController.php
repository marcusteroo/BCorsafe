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
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
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
        if (!isset($_SESSION['descuento'])) {
            $_SESSION['descuento'] = 0;
        }
    
        $detallePedidoDAO = new DetallePedidoDAO();
        $productoDAO = new ProductoDAO(); 
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
            $detalles = $detallePedidoDAO->obtenerDetallesPorPedido($pedidos->id_pedido);
            
            foreach ($detalles as $detalle) {
                $producto = $productoDAO->obtenerPorId($detalle->id_producto); 
                $detalle->producto = $producto; 
            }
        }
        $titulo = "Finalizar Compra";
        $vista = "web/View/pagina-compra.php";
        include_once("web/View/main/main.php");
    }
    public function confirmarCompra() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $id_usuario = $_SESSION['usuario_id'];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $direccion = $_POST['direccion'] ?? null;
            $ciudad = $_POST['ciudad'] ?? null;
            $codigo_postal = $_POST['codigo_postal'] ?? null;
            $pais = $_POST['pais'] ?? null;
    
            if (empty($direccion) || empty($ciudad) || empty($codigo_postal) || empty($pais)) {
                header("Location: /BCorsafe/pedido/error?mensaje=Faltan datos obligatorios");
                exit();
            }
    
            $metodoPagoDAO = new MetodoPagoDAO();
            $metodo_pago = $metodoPagoDAO->obtenerMetodosPorUsuario($id_usuario);
    
            if (empty($metodo_pago)) {
                header("Location: /BCorsafe/pedido/error?mensaje=No hay método de pago registrado para este usuario");
                exit();
            }
    
            $id_pago = $metodo_pago[0]->id_pago;
    
            $pedidoDAO = new PedidoDAO();
            $detallePedidoDAO = new DetallePedidoDAO();
    
            $pedido = $pedidoDAO->obtenerPedidoEnProceso($id_usuario);
            if (!$pedido) {
                header("Location: /BCorsafe/pedido/error?mensaje=No hay un pedido en proceso");
                exit();
            }
    
            $pedidoDAO->crearRegistro(
                $id_usuario,
                $pedido->id_pedido,
                $id_pago,
                $direccion,
                $ciudad,
                $codigo_postal,
                $pais
            );

            $pedidoDAO->actualizarEstadoPedido($pedido->id_pedido, 'completado');
            unset($_SESSION['descuento']);
            header("Location: /BCorsafe/pedidos/compraConfirmada");
            exit();
        } else {
            header("Location: /BCorsafe/pedido/error?mensaje=Solicitud inválida");
            exit();
        }
    }
    public function compraConfirmada() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        $titulo = "Compra confirmada";
        $vista = "web/View/compra_confirmada.php"; 
        include_once("web/View/main/main.php");
    }
    public function listarPedido() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }

        $id_usuario = $_SESSION['usuario_id'];
        $pedidosDAO = new PedidoDAO();
        $pedidos = $pedidosDAO->obtenerPedidosComprados($id_usuario);

        $titulo = "Mis Pedidos";
        $vista = "web/View/pedido_confirmado.php";
        include_once("web/View/main/main.php");
    }
    
    
    
    
}
?>
