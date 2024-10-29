<?php
include_once("web/config/parameters.php");
include_once("web/Controller/ProductosController.php");
include_once("web/Controller/HomeController.php");

// Verifica si `controller` está presente; si no, usa "home" por defecto
if (isset($_GET['controller'])) {
    // Si el parámetro "controller" está en la URL, se usa para construir el nombre del controlador
    $nombre_controller = $_GET['controller'] . "Controller";
} else {
    // Si no hay "controller" en la URL, se usa "HomeController" como valor predeterminado
    $nombre_controller = "HomeController";
}

// Verifica si `action` está presente; si no, usa "index" por defecto
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

if (class_exists($nombre_controller)) {
    $controller = new $nombre_controller();

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "La acción '$action' no existe en el controlador $nombre_controller.";
    }
} else {
    echo "El controlador '$nombre_controller' no existe.";
}
