<?php
class Category{
  private $conn;
  private $tableName = "categories";

  public $id;
  public $name;
  public $created;
  public $description;

  public function __construct($db){
    $this->conn = $db;
  }

  public function readAll(){
    $query = "SELECT id, name, description FROM {$this->tableName} ORDER BY name";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function read(){
    $query = "SELECT id, name, description FROM {$this->tableName} ORDER BY name";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }
}
?>