<?php
include_once 'web/Model/UsuarioDAO.php';
class UsuarioController {

    public function registro() {
        $titulo="Registrarse";
        $vista= 'web/View/register.php';
        include_once("web/View/main/main.php");
    }
    public function miCuenta(){
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit;
        }
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->obtenerPorId($_SESSION['usuario_id']);
        $titulo = "Mi Cuenta";
        $vista = 'web/View/miCuenta.php';
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

            // Esto lo que hace es que cuando se crear el usuario en la base de datos vuelve a hacer una consulta en la base de datos y busca ese mismo mail que ya se ha insertado antes en la base de datos para crear la sesion.
            $usuario = $usuarioDAO->getUsuarioByEmail($email);

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_id'] = $usuario['id_usuario']; 
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header("Location: /BCorsafe/");
            exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();  
                
            }
        }
       
        include_once("web/View/main/main.php");
    }
    public function cambiarContrasena(){
        session_start();
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
    
                    // Redirige al inicio
                    header("Location: /BCorsafe/");
                    exit;
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
                $_SESSION['mensaje_error'] = "La imagen supera el tamaño máximo de 2 MB.";
                header("Location: /BCorsafe/usuario/miCuenta");
                exit;
            }
    
            // Validar tipo de archivo
            $extensionesPermitidas = ['jpg', 'jpeg', 'png','webp'];
            $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                $_SESSION['mensaje_error'] = "Formato de imagen no permitido.";
                header("Location: /BCorsafe/usuario/miCuenta");
                exit;
            }
    
            // Guardar imagen
            $rutaDestino = "/BCorsafe/assets/img/"; 
            $nombreArchivo = "perfil_" . $_SESSION['usuario_id'] . "." . $extension;
            $rutaImagen = $rutaDestino.$nombreArchivo;
    
            // Actualizar ruta en la base de datos
            $usuarioDAO = new UsuarioDAO();
            $usuarioDAO->actualizarImagen($_SESSION['usuario_id'], $rutaImagen);
    
            $_SESSION['mensaje'] = "Imagen de perfil actualizada con éxito.";
            header("Location: /BCorsafe/usuario/miCuenta");
            exit;
        }
    }
}
?>