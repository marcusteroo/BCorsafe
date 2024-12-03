<?php
include_once 'web/Model/MetodoPagoDAO.php';
include_once 'BaseController.php';

class MetodosPagoController extends BaseController {
    public function agregar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['usuario_id'];
            $tipo_pago = htmlspecialchars($_POST['tipo_pago']);
            $numero_tarjeta = htmlspecialchars($_POST['numero_tarjeta']);
            $fecha_expiracion = htmlspecialchars($_POST['fecha_expiracion']);
            $codigo_seguridad = htmlspecialchars($_POST['codigo_seguridad']);

            // Validación adicional (si es necesario)
            if (!preg_match('/^\d{16}$/', $numero_tarjeta) || !preg_match('/^\d{3}$/', $codigo_seguridad)) {
                die("Datos inválidos.");
            }

            // Guardar en la base de datos
            $metodoPagoDAO = new MetodoPagoDAO();
            $metodoPagoDAO->insertarMetodoPago($id_usuario, $tipo_pago, $numero_tarjeta, $fecha_expiracion, $codigo_seguridad);

            header("Location: /BCorsafe/metodosPago/listar");
            exit();
        }
    }

    public function listar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }

        $metodoPagoDAO = new MetodoPagoDAO();
        $id_usuario = $_SESSION['usuario_id'];
        $metodos_pago = $metodoPagoDAO->obtenerMetodosPorUsuario($id_usuario);

        $titulo = "Mis Métodos de Pago";
        $vista = "web/View/metodos_pago_listar.php";
        include_once("web/View/main/main.php");
    }
    public function updatePago() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /BCorsafe/usuario/login");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['usuario_id'];
            $id_pago = htmlspecialchars($_POST['id_pago']); 
            $tipo_pago = htmlspecialchars($_POST['tipo_pago']);
            $numero_tarjeta = htmlspecialchars($_POST['numero_tarjeta']);
            $fecha_expiracion = htmlspecialchars($_POST['fecha_expiracion']);
            $codigo_seguridad = htmlspecialchars($_POST['codigo_seguridad']);
    
            // Validación adicional (si es necesario)
            if (!preg_match('/^\d{16}$/', $numero_tarjeta) || !preg_match('/^\d{3}$/', $codigo_seguridad)) {
                die("Datos inválidos.");
            }
    
            // Actualizar en la base de datos
            $metodoPagoDAO = new MetodoPagoDAO();
            $metodoPagoDAO->actualizarMetodoPago($id_pago, $id_usuario, $tipo_pago, $numero_tarjeta, $fecha_expiracion, $codigo_seguridad);
    
            header("Location: /BCorsafe/metodosPago/listar");
            exit();
        }
    }
    
}
