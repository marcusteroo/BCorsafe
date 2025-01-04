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
    //Para el admin
    public function eliminarPorId($id) {
        //Voy a utilizar un try para en casa de que el admin quiera borrar un usuario con un pedido en proceso se le avise que este no se puede eliminar.
        try {
            $stmt = $this->db->prepare("DELETE FROM Usuarios WHERE id_usuario = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // Detecta el error de restricción de clave foránea
            if ($e->getCode() === '23000') {
                throw new Exception("No se puede eliminar este usuario debido a que tiene pedidos o métodos de pago asociados.");
            } else {
                throw $e;
            }
        }
    }
    //Para obtener todos los usuarios para la pagina admin
    public function obtenerTodos() {
        $query = "SELECT * FROM Usuarios"; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Esta funcion es para actualizar el usuario en el admin
    public function actualizarUsuario($idUsuario, $nombre, $email, $telefono) {
        $query = "UPDATE Usuarios SET nombre = :nombre, email = :email, telefono = :telefono WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    
        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el usuario en la base de datos.");
        }
    }
    public function registrarCupon($nombre_cupon, $descuento) {
        $stmt = $this->db->prepare("INSERT INTO cupones (nombre_cupon, descuento) VALUES (:nombre_cupon, :descuento)");
        $stmt->bindParam(':nombre_cupon', $nombre_cupon);
        $stmt->bindParam(':descuento', $descuento);
        $stmt->execute();
    }
    public function obtenerCupones() {
        $stmt = $this->db->prepare("SELECT * FROM cupones");
        $stmt->execute(); 
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
