<?php
include_once '../BCorsafe/web/config/DBConnection.php'; 
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
