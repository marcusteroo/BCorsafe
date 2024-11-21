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
        $titulo="Registrarse";
        $vista= 'web/View/register.php';
        $errorMessage = null; 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  //Esto es para encriptar la contraseña
            $telefono = $_POST['tel'];
            $usuarioDAO = new UsuarioDAO();

            try {
            $usuarioDAO->registrarUsuario($username, $email, $telefono, $password);

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
}
?>