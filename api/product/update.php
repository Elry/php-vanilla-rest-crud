<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Controll-Allow-Headers, Authorization , X-Requested-With");

include_once "../config/database.php";
include_once "../objects/product.php";

$database = new DataBase();
$db = $database->getConn();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;

$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

if($product->update()){
  http_response_code(200);
  echo json_decode(array("message" => "Product updated"));
}else{
  http_response_code(503);
  echo json_encode(array("message" => "Unable to update product"));
}
?>
