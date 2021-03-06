<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");

include_once "../config/core.php";
include_once "../config/database.php";
include_once "../objects/product.php";

$database = new DataBase();
$db = $database->getConn();

$product = new Product($db);

$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $product->search($keywords);
$num = $stmt->rowCount();

if($num > 0){
  $productArr = array();
  $productArr["records"] = array();

  while($row = $stmmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $product_item = array(
      "id" => $id,
      "name" => $name,
      "description" => html_entity_decode($description),
      "price" => $price,
      "category_id" => $category_id,
      "category_name" => $category_name
    );

    array_push($productArr["records"], $product_item);
  }

  http_response_code(200);
  echo json_encode($productArr);
}else{
  http_response_code(404);
  echo json_encode(array("message" => "Could not find any register"));
}
?>