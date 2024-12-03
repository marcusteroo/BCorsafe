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
    //Esta funcion de contarDetallesPorPedido la he echo para poder contar cuantos pedidos osea cuantos diferentes productos tiene un usuario en la cesta
    public function contarDetallesPorPedido($id_pedido) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_productos FROM " . $this->getTableName() . " WHERE id_pedido = :id_pedido");
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total_productos'];
    }
    public function eliminarDetalle($id_detalle) {
        $stmt = $this->db->prepare("DELETE FROM Detalles_Pedido WHERE id_detalle = :id_detalle");
        $stmt->bindParam(':id_detalle', $id_detalle, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function actualizarDetalle($id_detalle, $cantidad, $precio_pedido, $ingredientes_custom) {
        $stmt = $this->db->prepare("
            UPDATE " . $this->getTableName() . " 
            SET cantidad = :cantidad, 
                precio_pedido = :precio_pedido, 
                ingredientes_custom = :ingredientes_custom
            WHERE id_detalle = :id_detalle
        ");
        $stmt->bindParam(':id_detalle', $id_detalle, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(':precio_pedido', $precio_pedido);
        $stmt->bindParam(':ingredientes_custom', $ingredientes_custom, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
