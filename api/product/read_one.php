<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new DataBase();
$db = $database->getConn();

$product = new Product($db);

$product->id = isset($_GET['id']) ? $_GET['id'] : die();

$product->readOne();

if($product->name != null){
  $product_arr = array(
    "id" => $product->id,
    "name" => $product->name,
    "price" => $product->price,
    "category_id" => $product->category_id,
    "description" => $product->description,
    "category_name" => $product->category_name,
  );

  http_response_code(200);
  echo json_decode($product_arr);
}else{
  http_response_code(404);
  echo json_encode(array("message" => "Product does not exist"));
}
?>