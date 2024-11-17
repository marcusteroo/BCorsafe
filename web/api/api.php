<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once $_SERVER['DOCUMENT_ROOT'] . '/BCorsafe/web/Model/ProductoDAO.php'; // El server document root sirve para detectar la ruta absoluta del proyecto
$productoDAO = new ProductoDAO();
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case 'POST':
        
        $data = json_decode(file_get_contents("php://input"), true);
        $precios = $data['precios'] ?? [];        
        $ingredientes = $data['ingredientes'] ?? []; 
    
        $productosFiltrados = $productoDAO->filtrarProductos($precios, $ingredientes);

        echo json_encode([
            'estado' => 'Exito',
            'data' => $productosFiltrados
        ]);
        break;

    default:
        echo json_encode(['estado' => 'Fallido', 'data' => 'Método no soportado']);
        http_response_code(405); 
        break;
}
?>
