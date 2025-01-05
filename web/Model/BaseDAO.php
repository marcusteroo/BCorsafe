<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/BCorsafe/web/config/DBconnection.php'; // El server document root sirve para detectar la ruta absoluta del proyecto 
abstract class BaseDAO {
    protected $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }

   
    abstract public function obtenerPorId($id);

    public function obtenerTodos() {
        $stmt = $this->db->prepare("SELECT * FROM " . $this->getTableName());
        $stmt->execute();
        
        $result = [];
        while ($row = $stmt->fetchObject($this->getClassName())) {
            $result[] = $row;
        }
        return $result;
    }

    abstract protected function getTableName();
    abstract protected function getClassName();
}
?>
