<?php
include_once 'BaseDAO.php';
include_once 'Usuario.php';

class UsuarioDAO extends BaseDAO {
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM Usuarios WHERE id_usuario = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Usuario');
    }

    protected function getTableName() {
        return "Usuarios";
    }

    protected function getClassName() {
        return "Usuario";
    }

    // Esto es un método para buscar por el correo
    public function obtenerPorEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM Usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchObject('Usuario');
    }
}
?>
