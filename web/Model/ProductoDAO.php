<?php
include_once 'web/config/DBConnection.php';
include_once 'Producto.php';

class ProductoDAO {
    private $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }

    public function obtenerTodos() {
        $stmt = $this->db->prepare("SELECT * FROM usuario");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Producto');
        return $result;
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Producto');
    }

    public function insertar(Producto $producto) {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, precio) VALUES (:nombre, :precio)");
        $stmt->bindParam(':nombre', $producto->nombre);
        $stmt->bindParam(':precio', $producto->precio);
        return $stmt->execute();
    }

}
?>
