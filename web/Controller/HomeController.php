<?php
include_once 'BaseController.php';
class HomeController extends BaseController {
    public function index() {
        $titulo = "BCorsafe";
        $vista = "web/View/home.php";
        include_once("web/View/main/main.php");
        
    }
    
}
