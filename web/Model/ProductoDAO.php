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
    public function obtenerProductosFiltrados($precios, $ingredientes) {
        $query = "SELECT * FROM Productos WHERE 1=1";
        $params = [];

        if (!empty($precios)) {
            $query .= " AND precio IN (" . implode(',', array_fill(0, count($precios), '?')) . ")";
            $params = array_merge($params, $precios);
        }

        if (!empty($ingredientes)) {
            foreach ($ingredientes as $ingrediente) {
                $query .= " AND ingredientes LIKE ?";
                $params[] = '%' . $ingrediente . '%';
            }
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        $productos = [];
        while ($producto = $stmt->fetchObject()) {
            $productos[] = $producto;
        }

        return $productos;
    }
}
?>
