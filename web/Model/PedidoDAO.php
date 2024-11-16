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
    public function obtenerPedidosPorUsuario($idUsuario) {
        $stmt = $this->db->prepare("SELECT * FROM Pedidos WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->execute();

        $result = [];
        while ($row = $stmt->fetchObject('Pedido')) {
            $result[] = $row;
        }
        return $result;
    }
}
?>
