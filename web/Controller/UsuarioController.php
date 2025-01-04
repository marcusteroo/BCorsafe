<?php
include_once 'web/Model/UsuarioDAO.php';
include_once 'BaseController.php';
class UsuarioController extends BaseController {

    public function registro() {
        $titulo="Registrarse";
        $vista= 'web/View/register.php';
        $admin = false;
        include_once("web/View/main/main.php");
    }
    public function miCuenta(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit;
        }
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->obtenerPorId($_SESSION['usuario_id']);
        $titulo = "Mi Cuenta";
        $vista = 'web/View/miCuenta.php';
        $admin = false;
        include_once("web/View/main/main.php"); 
    }
    public function registrar() {
        if (isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo="Registrarse";
        $vista= 'web/View/register.php';
        $errorMessage = null; 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  //Esto es para encriptar la contraseña
            $telefono = $_POST['tel'];
            $imagen = "/BCorsafe/assets/img/Default.webp";
            $usuarioDAO = new UsuarioDAO();

            try {
            $usuarioDAO->registrarUsuario($username, $email, $telefono, $password,$imagen);

            // Esto lo que hace es que cuando se crea el usuario en la base de datos vuelve a hacer una consulta en la base de datos y busca ese mismo mail que ya se ha insertado antes en la base de datos para crear la sesion.
            $usuario = $usuarioDAO->getUsuarioByEmail($email);

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_id'] = $usuario['id_usuario']; 
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['imagen_perfil']= $usuario['imagen'];
            if($usuario['nombre']=="admin" && $usuario['email']=="admin@hotmail.com" ){
                header("Location: /BCorsafe/admin/adminPage");
                exit;
            }
            else{
                header("Location: /BCorsafe/");
                exit;
            }
            
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();  
                
            }
        }
        $admin = false;
        include_once("web/View/main/main.php");
    }
    public function cambiarContrasena(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->obtenerPorId($_SESSION['usuario_id']);
            
            $actual = $_POST['actual_contrasena'];
            $nueva = $_POST['nueva_contrasena'];

            // password_very es una funcion de php para verificar contraseñas encriptadas
            if (password_verify($actual, $usuario->contrasena)) {
                // Si la contraseña actual es correcta, actualiza la contraseña
                $nueva_hash = password_hash($nueva, PASSWORD_DEFAULT);  // Encripta la nueva contraseña
                $usuarioDAO->actualizarContrasena($usuario->id_usuario, $nueva_hash);

                // Para volver a la pagina micuenta.php con un mensaje de éxito
                $_SESSION['mensaje'] = "Contraseña cambiada con éxito.";
                header("Location: /BCorsafe/usuario/miCuenta");
                exit;
            } else {
                $_SESSION['mensaje_error'] = "La contraseña actual es incorrecta.";
            }
        }

        $titulo = "Cambiar Contraseña";
        $vista = 'web/View/cambiar-contrasena.php';
        $admin = false;
        include_once("web/View/main/main.php");

    }
    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/");
            exit;
        }
        $titulo = "Iniciar Sesión";
        $vista = 'web/View/login.php';
        $admin = false;
        $errorMessage = null;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $usuarioDAO = new UsuarioDAO();
    
            try {
                $usuario = $usuarioDAO->getUsuarioByEmail($email);
    
                if ($usuario && password_verify($password, $usuario['contrasena'])) {
                    $_SESSION['usuario_id'] = $usuario['id_usuario'];
                    $_SESSION['usuario_nombre'] = $usuario['nombre'];
                    $_SESSION['usuario_email'] = $usuario['email'];
                    $_SESSION['imagen_perfil']= $usuario['imagen'];
                    if($usuario['nombre']=="admin" && $usuario['email']=="admin@hotmail.com" ){
                        header("Location: /BCorsafe/admin/adminPage");
                        exit;
                    }
                    else{
                        // Redirige al inicio
                        header("Location: /BCorsafe/");
                        exit;
                    }
                    
                } else {
                    // Credenciales inválidas
                    $_SESSION['mensaje_error'] = "Correo o contraseña incorrectos.";
                }
            } catch (Exception $e) {
                $_SESSION['mensaje_error'] = "Error al iniciar sesión: " . $e->getMessage();
            }
        }
    
        include_once("web/View/main/main.php");
    }
    public function cerrarSesion() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        session_unset();
        session_destroy();
    
        header("Location: /BCorsafe/");
        exit;
    }
    public function subirImagen() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagenPerfil'])) {
            $imagen = $_FILES['imagenPerfil'];
    
            // Esto es para verificar si se pasa de 2mb
            if ($imagen['size'] > 2 * 1024 * 1024) {
                $_SESSION['mensaje_error_img'] = "La imagen supera el tamaño máximo de 2 MB.";
                header("Location: /BCorsafe/usuario/miCuenta");
                exit;
            }
    
            // Validar tipo de archivo
            $extensionesPermitidas = ['jpg', 'jpeg', 'png','webp'];
            $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                $_SESSION['mensaje_error_img'] = "Formato de imagen no permitido.";
                header("Location: /BCorsafe/usuario/miCuenta");
                exit;
            }
    
            $rutaDestino = "/BCorsafe/assets/img/";
            $rutaDestino2 = __DIR__ . "/../../assets/img/";
            $nombreBase = "perfil_" . $_SESSION['usuario_id'];
            $nombreArchivo = $nombreBase . "." . $extension;
            $rutaImagen = $rutaDestino . $nombreArchivo;

            $extensionesExistentes = ['jpg', 'jpeg', 'png', 'webp']; 
            foreach ($extensionesExistentes as $ext) {
                $archivoExistente = $rutaDestino2 . $nombreBase . '.' . $ext;
                if (file_exists($archivoExistente)) {
                    unlink($archivoExistente);
                }
            }
            
            if (move_uploaded_file($imagen['tmp_name'], $rutaDestino2 . $nombreArchivo)) {
                $usuarioDAO = new UsuarioDAO();
                $usuarioDAO->actualizarImagen($_SESSION['usuario_id'], $rutaImagen);
                $_SESSION['imagen_perfil'] = $rutaImagen;
            } else {
                $_SESSION['mensaje_error_img'] = "No se pudo mover el archivo.";
            }
            header("Location: /BCorsafe/usuario/miCuenta");
            exit;
        }
    }
    public function listarContacto(){
        $titulo = "Contacto";
        $vista = "web/View/contacto.php";
        $admin = false;
        include_once("web/View/main/main.php");
    }
    //Esto es para las paginas de termino de uso y cookies
    public function terminosUso(){
        $titulo = "Términos de Uso";
        $vista = "web/View/terminos-uso.php";
        $admin = false;
        include_once("web/View/main/main.php");
    }
    public function politicaCookies(){
        $titulo = "Política de Cookies";
        $vista = "web/View/cookies.php";
        $admin = false;
        include_once("web/View/main/main.php");
    }
    
}
?>