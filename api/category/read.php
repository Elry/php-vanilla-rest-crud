<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/category.php";

$database = new DataBase();
$db = $database->getConn();

$category = new Category($db);

$stmt = $category->read();
$num = $stmt->rowCount();

if($num > 0){
  $categoryArr = array();
  $categoryArr["records"] = array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $categoryItem = array(
      "id" => $id,
      "name" => $name,
      "description" => html_entity_decode($description)
    );

    array_push($categoryArr["records"], $categoryItem);
  }

  http_response_code(200);
  echo json_encode($categoryArr);
}else{
  http_response_code(404);
  echo json_encode(array("message" => "Unable to read category"));
}
?>
