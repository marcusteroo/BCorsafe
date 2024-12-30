<?php
include_once("web/config/parameters.php");
include_once("web/Controller/ProductosController.php");
include_once("web/Controller/HomeController.php");
include_once("web/Controller/UsuarioController.php");
include_once("web/Controller/PedidosController.php");
include_once("web/Controller/BaseController.php");
include_once("web/Controller/MetodosPagoController.php");
include_once("web/Controller/AdminController.php");

// Obtiene la URL completa después de "index.php?url="
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Divide la URL en partes (por ejemplo, /productos/index se convierte en ['productos', 'index'])
$urlParts = explode('/', $url);

// El controlador por defecto es "HomeController"
$controller = !empty($urlParts[0]) ? ucfirst($urlParts[0]) . "Controller" : "HomeController";

// La acción por defecto es "index"
$action = isset($urlParts[1]) ? $urlParts[1] : "index";

// Verifica si el controlador existe
if (class_exists($controller)) {
    $controllerObj = new $controller();

    // Verifica si el método (acción) existe en el controlador
    if (method_exists($controllerObj, $action)) {
        // Llama al método de acción
        $controllerObj->$action();
    } else {
        echo "La acción '$action' no existe en el controlador '$controller'.";
    }
} else {
    echo "El controlador '$controller' no existe.";
}
