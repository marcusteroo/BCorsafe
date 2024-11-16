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
}
?>
