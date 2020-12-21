<?php
class DataBase{
  public $conn;
  private $db = "ayyy";
  private $user = "elry";
  private $pass = "lmao";
  private $host = "127.0.0.1";

  public function getConn(){
    $this->conn = null;
    
    try{
      $this->conn = new PDO("mysql:host=".$this->host.";dbname".$this->db, $this->user, $this->pass);
      $this->conn->exec("set names utf8");
    }catch(PDOException $except){
      echo "Conn err:". $except->getMessage();
    }

    return $this->conn;
  }
}
?>
