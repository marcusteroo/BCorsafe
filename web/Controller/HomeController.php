<?php
class HomeController {
    public function index() {
        $titulo = "Home";
        $vista = "web/View/home.php";
        include_once("web/View/main/main.php");
        
    }
}
