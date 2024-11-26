<?php
include_once 'BaseDAO.php';
include_once 'DetallePedido.php';

class DetallePedidoDAO extends BaseDAO {
    protected function getTableName() {
        return 'Detalles_Pedido';
    }
    protected function getClassName() {
        return DetallePedido::class;
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->getTableName() . " WHERE id_detalle = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject($this->getClassName());
    }
    public function agregarDetalle($id_pedido,$id_producto , $cantidad, $precio_pedido, $ingredientes_custom) {
        $stmt = $this->db->prepare("
            INSERT INTO " . $this->getTableName() . " (id_pedido, id_producto,cantidad, precio_pedido, ingredientes_custom)
            VALUES (:id_pedido, :id_producto, :cantidad, :precio_pedido, :ingredientes_custom)
        ");
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':precio_pedido', $precio_pedido);
        $stmt->bindParam(':ingredientes_custom', $ingredientes_custom, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function obtenerDetallesPorPedido($id_pedido) {
        $stmt = $this->db->prepare("
            SELECT dp.*, p.nombre AS nombre_producto 
            FROM " . $this->getTableName() . " dp
            JOIN Productos p ON dp.id_producto = p.id_producto
            WHERE dp.id_pedido = :id_pedido
        ");
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->execute();

        $detalles = [];
        while ($detalle = $stmt->fetchObject($this->getClassName())) {
            $detalles[] = $detalle;
        }
        return $detalles;
    }
}
?>
