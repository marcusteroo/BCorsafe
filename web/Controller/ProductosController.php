<?php
include_once 'web/Model/ProductoDAO.php';

class ProductosController {
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
}
?>
