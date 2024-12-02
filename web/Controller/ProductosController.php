<?php
include_once 'web/Model/ProductoDAO.php';
include_once 'BaseController.php';
class ProductosController extends BaseController {
    public function index() {
        $productoDAO = new ProductoDAO();
        $productos = $productoDAO->obtenerTodos();
        
        $titulo = "Productos";
        $vista = "web/View/productos.php";
        
        include_once("web/View/main/main.php");
    }

    public function mostrarProducto($id) {
        $productoDAO = new ProductoDAO();
        $producto = $productoDAO->obtenerPorId($id);

        if ($producto) {
            $titulo = "Detalle del Producto";
            $vista = "web/View/detalle_producto.php";
            include_once("web/View/main/main.php");
        } else {
            echo "Producto no encontrado.";
        }
    }
    public function filtrar() {
        $titulo = "Productos";
        $vista = "web/View/productos.php";
        $precios = $_POST['precios'] ?? [];
        $ingredientes = $_POST['ingredientes'] ?? [];
        
        $productoModel = new ProductoDAO();
        
        $productos = $productoModel->obtenerProductosFiltrados($precios, $ingredientes);
        include_once("web/View/main/main.php");
        include_once "web/View/productos.php";
    }
    public function detalle() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: /BCorsafe/productos");
            exit();
        }
    
        $idProducto = $_GET['id'];
        $productoDAO = new ProductoDAO();
    
        // Esto es para obtener los datos del producto
        $producto = $productoDAO->getProductoById($idProducto);
        if (!$producto) {
            // Redirigir si el producto no existe
            header("Location: /BCorsafe/productos");
            exit();
        }
    
        // esto es para obtener los ingredientes
        $ingredientes = $productoDAO->getIngredientesByProductoId($idProducto);
    
        // Renderizar la vista
        $titulo = "Detalle del Producto";
        $vista = 'web/View/producto_detalle.php';
        include_once("web/View/main/main.php");
    }
    
    
}
?>
