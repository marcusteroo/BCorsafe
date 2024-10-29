<?php
class ProductosController {
    public function index() {
        $titulo = "Productos";
        $vista = "web/View/productos.php";
        include_once("web/View/main/main.php");
    }
}
