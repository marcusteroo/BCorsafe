<?php
include_once 'BaseDAO.php';

class MetodoPagoDAO extends BaseDAO {
    protected function getTableName() {
        return 'Metodos_Pago';
    }
    protected function getClassName() {
        return "Metodos_Pago";
    }
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->getTableName() . " WHERE id_detalle = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject($this->getClassName());
    }


    public function insertarMetodoPago($id_usuario, $tipo_pago, $numero_tarjeta, $fecha_expiracion, $codigo_seguridad) {
        $stmt = $this->db->prepare("
            INSERT INTO " . $this->getTableName() . " 
            (id_usuario, tipo_pago, numero_tarjeta, fecha_expiracion, codigo_seguridad)
            VALUES (:id_usuario, :tipo_pago, :numero_tarjeta, :fecha_expiracion, :codigo_seguridad)
        ");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':numero_tarjeta', $numero_tarjeta, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_expiracion', $fecha_expiracion, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_seguridad', $codigo_seguridad, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function obtenerMetodosPorUsuario($id_usuario) {
        $stmt = $this->db->prepare("
            SELECT * FROM " . $this->getTableName() . " 
            WHERE id_usuario = :id_usuario
        ");
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function actualizarMetodoPago($id_pago, $id_usuario, $tipo_pago, $numero_tarjeta, $fecha_expiracion, $codigo_seguridad) {
        $sql = "UPDATE Metodos_Pago
                SET tipo_pago = :tipo_pago,
                    numero_tarjeta = :numero_tarjeta,
                    fecha_expiracion = :fecha_expiracion,
                    codigo_seguridad = :codigo_seguridad
                WHERE id_pago = :id_pago AND id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pago', $id_pago, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_pago', $tipo_pago, PDO::PARAM_STR);
        $stmt->bindParam(':numero_tarjeta', $numero_tarjeta, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_expiracion', $fecha_expiracion, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_seguridad', $codigo_seguridad, PDO::PARAM_STR);
        $stmt->execute();
    }
}
