<?php
// web/Controller/ProductosController.php
include_once 'web/Model/ProductoDAO.php';

class ProductosController {
    public function index() {
        $productoDAO = new ProductoDAO();
        $productos = $productoDAO->obtenerTodos();
        
        $titulo = "Productos";
        $vista = "web/View/productos.php";
        
        include_once("web/View/main/main.php");
    }

    // Puedes agregar más métodos para crear, actualizar, eliminar productos, etc.
}
?>
