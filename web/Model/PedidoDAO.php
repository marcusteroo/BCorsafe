<?php
include_once 'BaseDAO.php';
include_once 'Pedido.php';

class PedidoDAO extends BaseDAO {
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM Pedidos WHERE id_pedido = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Pedido');
    }

    protected function getTableName() {
        return "Pedidos";
    }

    protected function getClassName() {
        return "Pedido";
    }

    // Este método obtiene todos los pedidos de un usuario con la id
    public function obtenerPedidoPorId($id_pedido) {
        $stmt = $this->db->prepare("SELECT * FROM Pedidos WHERE id_pedido = :id_pedido");
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(); 
    }
    //Función para los pedidos que no se han pagado aun
    public function obtenerPedidoEnProceso($id_usuario) {
        $stmt = $this->db->prepare("
            SELECT * FROM Pedidos 
            WHERE id_usuario = :id_usuario AND id_pago IS NULL
        ");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    public function crearPedido($id_usuario) {
        $stmt = $this->db->prepare("
            INSERT INTO Pedidos (id_usuario, fecha_pedido, monto_total, id_pago)
            VALUES (:id_usuario, NOW(), 0, NULL)
        ");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $this->obtenerPedidoPorId($this->db->lastInsertId());
    }
    public function actualizarMontoTotal($id_pedido, $monto_total) {
        $stmt = $this->db->prepare("UPDATE Pedidos SET monto_total = :monto_total WHERE id_pedido = :id_pedido");
        $stmt->bindParam(':monto_total', $monto_total);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->execute();
    }

}
?>
