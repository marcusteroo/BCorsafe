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

    public function registrarUsuario($username, $email, $telefono, $password,$imagen) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM Usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        // Esto es para verificar si existe el correo
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("El correo electrónico ya está registrado.");
        }
        $stmt = $this->db->prepare("INSERT INTO Usuarios (nombre, email, telefono, contrasena,imagen) VALUES (:nombre, :email, :telefono, :contrasena,:imagen)");
        $stmt->bindParam(':nombre', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':contrasena', $password);
        $stmt->bindParam(':imagen', $imagen);

        $stmt->execute();
    }

    public function getUsuarioByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM Usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarContrasena($id_usuario, $nueva_contrasena) {
        $stmt = $this->db->prepare("UPDATE Usuarios SET contrasena = :contrasena WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':contrasena', $nueva_contrasena);
        $stmt->execute();
    }
    public function actualizarImagen($id_usuario, $imagen) {
        $stmt = $this->db->prepare("UPDATE Usuarios SET imagen = :imagen WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->execute();
    }
}
?>
