<?php
// web/config/DBConnection.php
class DBConnection {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // Configura tus credenciales de base de datos
        $host = 'localhost';
        $dbname = 'db_prueba';
        $username = 'root';
        $password = 'admin';

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }

        return self::$instance->connection;
    }
}
?>
