<?php
include_once __DIR__ . '/../Model/PedidoDAO.php';
include_once __DIR__ . '/../Model/UsuarioDAO.php';
include_once __DIR__ . '/../Model/ProductoDAO.php';
include_once 'BaseController.php';
class AdminController extends BaseController {
    public function adminPage() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($_SESSION['usuario_nombre']!="admin" && $_SESSION['usuario_email']!="admin@hotmail.com" ){
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo = "Admin";
        $vista = "web/View/panel-admin.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    public function adminPage3Pedidos() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($_SESSION['usuario_nombre']!="admin" && $_SESSION['usuario_email']!="admin@hotmail.com" ){
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo = "Ultimos 3 Pedidos";
        $vista = "web/View/admin-page3Pedidos.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    public function usuarioAdmin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($_SESSION['usuario_nombre']!="admin" && $_SESSION['usuario_email']!="admin@hotmail.com" ){
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo = "User Admin";
        $vista = "web/View/user-admin.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    public function NewusuarioAdmin() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($_SESSION['usuario_nombre']!="admin" && $_SESSION['usuario_email']!="admin@hotmail.com" ){
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo = "Añadir Usuario";
        $vista = "web/View/Newuser-admin.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    public function editarUsuarioPage() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['usuario_nombre'] != "admin" && $_SESSION['usuario_email'] != "admin@hotmail.com") {
            header("Location: /BCorsafe/");
            exit;
        }
        $idUsuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : null;
        if (!$idUsuario) {
            header("Location: /BCorsafe/admin/usuarioAdmin");
            exit;
        }
    
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->obtenerPorId($idUsuario);
    
        if (!$usuario) {
            header("Location: /BCorsafe/admin/usuarioAdmin");
            exit;
        }
    
        $titulo = "Editar Usuario";
        $vista = "web/View/edit-user.php";
        $admin = true;
        include_once("web/View/main/main.php");
    }
    public function adminProductos() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($_SESSION['usuario_nombre']!="admin" && $_SESSION['usuario_email']!="admin@hotmail.com" ){
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo = "Admin";
        $vista = "web/View/producto-admin.php";
        $admin = true;
        include_once("web/View/main/main.php");
        
    }
    // Obtener todos los pedidos
    public function obtenerTodosLosPedidos() {
        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->obtenerTodos(); // Método para obtener todos los pedidos

        echo json_encode([
            'estado' => 'Exito',
            'data' => $pedidos
        ]);
    }

    // Eliminar un pedido
    public function eliminarPedido($id_pedido) {
        if (!$id_pedido) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'ID de pedido no proporcionado'
            ]);
            return;
        }

        $pedidoDAO = new PedidoDAO();
        $pedidoDAO->eliminarPedido($id_pedido); // Método para eliminar pedido

        echo json_encode([
            'estado' => 'Exito',
            'mensaje' => 'Pedido eliminado correctamente'
        ]);
    }
    public function eliminarUsuario($id_usuario) {
        if (!$id_usuario) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'ID de usuario no proporcionado'
            ]);
            return;
        }

        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->eliminarPorId($id_usuario); // Método para eliminar usurio

        echo json_encode([
            'estado' => 'Exito',
            'mensaje' => 'Usuario eliminado correctamente'
        ]);
    }

    // Esta funcion la estoy haciendo para utilizar arrays en una SESION (Peticion de David)
    public function mostrar3ultimosPedidos($id_usuario) {
        if (!$id_usuario) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'ID de usuario no proporcionado'
            ]);
            return;
        }

        $pedidoDAO = new PedidoDAO();
        $pedidos = $pedidoDAO->obtenerPedidosCompletadosYUltimos();

        // Guardar en sesión
        $_SESSION['ultimos_pedidos'] = $pedidos;

        echo json_encode([
            'estado' => 'Exito',
            'data' => $pedidos
        ]);
    }
    public function obtenerTodosLosUsuarios() {
        $usuarioDAO = new UsuarioDAO();
        $usuarios = $usuarioDAO->obtenerTodos();
    
        echo json_encode([
            'estado' => 'Exito',
            'data' => $usuarios
        ]);
    }
    public function anadirUsuario() {
        $data = json_decode(file_get_contents("php://input"), true);
    
        $nombre = $data['username'] ?? null;
        $email = $data['email'] ?? null;
        $telefono = $data['tel'] ?? null;
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $imagen = "/BCorsafe/assets/img/Default.webp"; // Imagen predeterminada
    
        if (!$nombre || !$email || !$telefono) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'Faltan datos para añadir el usuario'
            ]);
            return;
        }
    
        $usuarioDAO = new UsuarioDAO();
        try {
            $usuarioDAO->registrarUsuario($nombre, $email, $telefono, $password, $imagen);
            echo json_encode([
                'estado' => 'Exito',
                'mensaje' => 'Usuario añadido correctamente'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'Error al añadir el usuario: ' . $e->getMessage()
            ]);
        }
    }
    //Esto es para editar el usuario en el admin
    public function editarUsuarioAdmin() {
        // Leer datos JSON del cuerpo de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);
    
        $idUsuario = $data['idUsuario'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $email = $data['email'] ?? null;
        $telefono = $data['telefono'] ?? null;
    
        if (!$idUsuario || !$nombre || !$email || !$telefono) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'Faltan datos para editar el usuario'
            ]);
            return;
        }
    
        $usuarioDAO = new UsuarioDAO();
        try {
            $usuarioDAO->actualizarUsuario($idUsuario, $nombre, $email, $telefono);
            echo json_encode([
                'estado' => 'Exito',
                'mensaje' => 'Usuario actualizado correctamente'
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'Error al actualizar el usuario: ' . $e->getMessage()
            ]);
        }
    }
    public function obtenerTodosLosProductos() {
        $productoDAO = new ProductoDAO();
    
        $productos = $productoDAO->obtenerTodosProductosAdmin();
        if ($productos) {
            echo json_encode(['estado' => 'Exito', 'productos' => $productos]);
        } else {
            echo json_encode(['estado' => 'Error', 'mensaje' => 'No se encontraron productos.']);
        }
        exit;
    }
    public function anadirProducto() {
        $productoDAO = new ProductoDAO();
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? 0.0;
        $rutaImagen = null;
        $ingredientes = $_POST['ingredientes'] ?? [];
        if (count($ingredientes) < 2 || count($ingredientes) > 5) {
            echo json_encode([
                'estado' => 'Fallido',
                'mensaje' => 'Debes seleccionar entre 2 y 5 ingredientes.'
            ]);
            return;
        }
        // Esto es para validar si se ha subido la imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen'];
            $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            $nombreArchivo = uniqid('producto_') . '.' . $extension;
            $rutaDestino = __DIR__ . "/../../assets/img/" . $nombreArchivo;
            $rutaImagen = "/BCorsafe/assets/img/" . $nombreArchivo;
    
            // Intentar mover la imagen al destino
            if (!move_uploaded_file($imagen['tmp_name'], $rutaDestino)) {
                echo json_encode(['estado' => 'Error', 'mensaje' => 'Error al subir la imagen.']);
                exit; // Asegúrate de salir después de enviar el error
            }
        } else {
            echo json_encode(['estado' => 'Error', 'mensaje' => 'No se recibió una imagen o hubo un error en la carga.']);
            exit; // Asegúrate de salir después de enviar el error
        }
    
        // Crear el producto
        $resultado = $productoDAO->crearProducto($nombre, $descripcion, $precio, $rutaImagen);
    
        // Comprobar si se ha creado el producto correctamente
        if ($resultado) {
            // Obtener el ID del producto insertado 
            $idProducto = $productoDAO->obtenerUltimoIdProducto();
    
            // Insertar los ingredientes en la tabla Productos_Ingredientes
            foreach ($ingredientes as $idIngrediente) {
                $productoDAO->agregarIngredienteAProducto($idProducto, $idIngrediente);
            }
    
            echo json_encode(['estado' => 'Exito', 'mensaje' => 'Producto añadido correctamente.']);
        } else {
            echo json_encode(['estado' => 'Error', 'mensaje' => 'No se pudo añadir el producto.']);
        }
        exit;
    }
    
}
?>
