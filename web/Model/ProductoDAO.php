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
        $query = "
            SELECT DISTINCT p.*
            FROM Productos p
            LEFT JOIN Productos_Ingredientes pi ON p.id_producto = pi.id_producto
            LEFT JOIN Ingredientes i ON pi.id_ingrediente = i.id_ingrediente
            WHERE 1=1";
        $params = [];
    
        if (!empty($precios)) {
            $query .= " AND p.precio IN (" . implode(',', array_fill(0, count($precios), '?')) . ")";
            $params = array_merge($params, $precios);
        }
    
        if (!empty($ingredientes)) {
            $placeholders = implode(' OR ', array_fill(0, count($ingredientes), 'i.nombre_ingrediente LIKE ?'));
            $query .= " AND (" . $placeholders . ")";
            foreach ($ingredientes as $ingrediente) {
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
    //En esta función he utilizado el fetchAll porque con el fetch object necesito los atributos y esto es de una tabla en la base de datos que he utilizado para relacionar dos tablas
    public function getIngredientesByProductoId($idProducto) {
        $stmt = $this->db->prepare("
            SELECT i.nombre_ingrediente, pi.cantidad
            FROM Productos_Ingredientes pi
            JOIN Ingredientes i ON pi.id_ingrediente = i.id_ingrediente
            WHERE pi.id_producto = :id_producto
        ");
        $stmt->bindParam(':id_producto', $idProducto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getProductoById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Productos WHERE id_producto = :id_producto");
        $stmt->bindParam(':id_producto', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ); 
    }
    public function verificarCupon($nombreCupon) {
        $stmt = $this->db->prepare("SELECT descuento FROM cupones WHERE nombre_cupon = :nombre_cupon");
        $stmt->bindParam(':nombre_cupon', $nombreCupon, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    //Para el admin
    public function insertar($producto) {
        $stmt = $this->db->prepare("INSERT INTO Productos (nombre, precio) VALUES (:nombre, :precio)");
        $stmt->bindParam(':nombre', $producto->nombre);
        $stmt->bindParam(':precio', $producto->precio);
        $stmt->execute();
    }
}
?>
