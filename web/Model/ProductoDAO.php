<?php
include_once 'BaseDAO.php';
include_once 'Producto.php';

class ProductoDAO extends BaseDAO {
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM Productos WHERE id_producto = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Producto');
    }

    protected function getTableName() {
        return "Productos";
    }

    protected function getClassName() {
        return "Producto";
    }
}
?>
