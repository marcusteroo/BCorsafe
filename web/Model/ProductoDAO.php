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


    public function filtrarProductos($precios = [], $ingredientes = []) {
        $query = "SELECT * FROM Productos WHERE 1=1";  // para añadir filtros de manera dinámica
        
        if (!empty($precios)) {
            $placeholders = implode(",", array_fill(0, count($precios), "?"));
            $query .= " AND precio IN ($placeholders)";
        }

        if (!empty($ingredientes)) {
            $ingredientesPlaceholder = implode(",", array_fill(0, count($ingredientes), "?"));
            $query .= " AND EXISTS (
                            SELECT 1 FROM Ingredientes 
                            WHERE Ingredientes.id_producto = Productos.id_producto
                            AND Ingredientes.nombre IN ($ingredientesPlaceholder)
                        )";
        }

        $stmt = $this->db->prepare($query);
        $params = array_merge($precios, $ingredientes); 
        $stmt->execute($params);

        $result = [];
        while ($row = $stmt->fetchObject('Producto')) {
            $result[] = $row;
        }

        return $result;
    }
    
    protected function getTableName() {
        return "Productos";
    }

    protected function getClassName() {
        return "Producto";
    }
}
?>
