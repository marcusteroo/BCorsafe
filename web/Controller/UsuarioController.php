<?php
include_once 'web/Model/UsuarioDAO.php';
class UsuarioController {

    public function registro() {
        // Muestra el formulario de registro
        $titulo="Registrarse";
        $vista= 'web/View/register.php';
        include_once("web/View/main/main.php");
    }

    public function registrar() {
        $titulo="Registrarse";
        $vista= 'web/View/register.php';
        include_once("web/View/main/main.php");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir los datos del formulario
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  //Esto es para encriptar la contraseña
            $telefono = $_POST['tel'];
            $usuarioDAO = new UsuarioDAO();

            try {
            $usuarioDAO->registrarUsuario($username, $email, $telefono, $password);

            // Esto lo que hace es que cuando se crear el usuario en la base de datos vuelve a hacer una consulta en la base de datos y busca ese mismo mail que ya se ha insertado antes en la base de datos para crear la sesion.
            $usuario = $usuarioDAO->getUsuarioByEmail($email);

            session_start(); 
            $_SESSION['usuario_id'] = $usuario['id_usuario']; 
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header("Location: /BCorsafe/");
            exit;
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();  
                
                include_once('web/View/register.php'); 
                exit;
            }
        }
    }
}
?>