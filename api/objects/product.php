<?php
class Product{
  private $conn;
  private $tableName = "products";
  
  public $id;
  public $name;
  public $price;
  public $created;
  public $description;
  public $category_id;
  public $category_name;

  public function __construct($db){
    $this->conn = $db;      
  }

  public function read(){
    $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM {$this->tableName} p
      LEFT JOIN categories c ON p.category_id = c.id
      ORDER BY p.created DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  public function create(){
    $query = "INSERT INTO {$this->tableName} SET name=:name, price=:price, description=:description, category_id=:category_id, created=:created";

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->created = htmlspecialchars(strip_tags($this->created));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":created", $this->created);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":category_id", $this->category_id);
  }

  public function readOne(){
    $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM {$this->tableName} p LEFT JOIN categories c ON p.category_id = c.id
    WHERE P.id = ? LIMIT 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->name = $row["name"];
    $this->price = $row["price"];
    $this->description = $row["description"];
    $this->category_id = $row["category_id"];
    $this->category_name = $row["category_name"];
  }

  public function update(){
    $query = "UPDATE ".$this->tableName." SET name=:name, price=:price, description=:description, category_id=:category_id WHERE id=:id";

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->created = htmlspecialchars(strip_tags($this->created));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->category_id = htmlspecialchars(strip_tags($this->category_id));

    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":created", $this->created);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":category_id", $this->category_id);

    if($stmt->execute()){
      return true;
    }

    return false;
  }

  public function delete(){
    $query = "DELETE FROM ".$this->tableName." WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(1, $this->id);

    if($stmt->execute()){
      return true;
    }
    return false;
  }

  public function search($keywords){
    $query = "SELECT c.name as category_name, p.id, p.description, p.price, p.category_id, p.created FROM {$this->tableName} p LEFT JOIN categories c
      ON p.category_id = c.id WHERE p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
      ORDER BY p.created DESC
    ";

    $stmt = $this->conn->prepare($query);

    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);

    $stmt->execute();
    return $stmt;
  }

  public function readPaging($recordNum, $recordPage){
    $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM {$this->tableName}
      p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created DESC LIMIT ?, ?
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $recordNum, PDO::PARAM_INT);
    $stmt->bindParam(2, $recordPage, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt;
  }

  public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM {$this->tableName}";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row["total_rows"];
  }
}
?>