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

}
?>
