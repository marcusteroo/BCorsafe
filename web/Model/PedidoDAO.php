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
            WHERE id_usuario = :id_usuario AND estado = 'pendiente'
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
    public function crearRegistro($id_usuario, $id_pedido, $id_pago, $direccion, $ciudad, $codigo_postal, $pais) {
        $stmt = $this->db->prepare("
            INSERT INTO Pedidos_Comprados (id_usuario, id_pedido, id_pago, direccion, ciudad, codigo_postal, pais)
            VALUES (:id_usuario, :id_pedido, :id_pago, :direccion, :ciudad, :codigo_postal, :pais)
        ");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_pago', $id_pago, PDO::PARAM_INT);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $codigo_postal, PDO::PARAM_STR);
        $stmt->bindParam(':pais', $pais, PDO::PARAM_STR);
    
        $stmt->execute();
    }
    public function eliminarPedido($id_pedido) {
        try {
            // Se inicia una transacción para asegurarse de que los dos DELETE se ejecuten correctamente
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("DELETE FROM Detalles_Pedido WHERE id_pedido = :id_pedido");
            $stmt->bindParam(':id_pedido', $id_pedido);
            $stmt->execute();
    
            $stmt = $this->db->prepare("DELETE FROM Pedidos WHERE id_pedido = :id_pedido");
            $stmt->bindParam(':id_pedido', $id_pedido);
            $stmt->execute();
    
            // Confirmar la transacción
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e; // Re-lanzar el error para manejarlo en el controlador
        }
    }
    public function actualizarEstadoPedido($id_pedido, $estado) {
        $query = "UPDATE Pedidos SET estado = :estado WHERE id_pedido = :id_pedido";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_pedido', $id_pedido);
        return $stmt->execute();
    }
    public function obtenerPedidosComprados($id_usuario) {
        $stmt = $this->db->prepare("
            SELECT pc.id_compra, pc.direccion, pc.ciudad, pc.codigo_postal, pc.pais, 
                   dp.id_producto, dp.cantidad, dp.precio_pedido, 
                   p.nombre, p.img, p.descripcion
            FROM Pedidos_Comprados pc
            JOIN Detalles_Pedido dp ON pc.id_pedido = dp.id_pedido
            JOIN Productos p ON dp.id_producto = p.id_producto
            WHERE pc.id_usuario = :id_usuario
            ORDER BY pc.id_compra DESC
        ");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPedidosCompletadosYUltimos() {
        // Esta funcion la estoy haciendo para utilizar arrays en una SESION (Peticion de David)
        $stmt = $this->db->prepare("
            SELECT * FROM Pedidos 
            WHERE estado = 'completado'
            ORDER BY id_pedido DESC 
            LIMIT 3
        ");
        $stmt->execute();
        // Guardar resultados en la sesión
        $pedidos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $_SESSION['ultimos_pedidos'] = $pedidos;
        return $pedidos;
    }
    

    

}
?>
