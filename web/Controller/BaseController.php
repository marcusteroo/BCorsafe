<?php
    //Este controlador es para poder utilizarlo en la web, en el caso de saber cuantos productos hay en el carrito lo necesito saber en toda la web ya que se muestran en el header con el icono de carrito
    class BaseController {
        protected $cantidad_productos;

        public function __construct() {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $this->cantidad_productos = 0;

            if (isset($_SESSION['usuario_id'])) {
                $id_usuario = $_SESSION['usuario_id'];
                $pedidoDAO = new PedidoDAO();
                $detallePedidoDAO = new DetallePedidoDAO();

                $pedido = $pedidoDAO->obtenerPedidoEnProceso($id_usuario);
                if ($pedido) {
                    $this->cantidad_productos = $detallePedidoDAO->contarDetallesPorPedido($pedido->id_pedido);
                }
            }
        }

        public function getCantidadProductos() {
            return $this->cantidad_productos;
        }
    }

?>