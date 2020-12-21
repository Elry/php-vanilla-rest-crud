<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/core.php";
include_once "../config/database.php";
include_once "../objects/product.php";
include_once "../shared/utilities.php";

$utilities = new Utilities();

$database = new DataBase();
$db = $database->getConn();

$product = new Product($db);

$stmt = $product->readPaging($recordNum, $recordsPage);
$num = $stmt->rowCount();

if($num > 0){
  $productArr = array();
  $productArr["paging"] = array();
  $productArr["records"] = array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $product_item = array(
      "id" => $id,
      "name" => $name,
      "description" => $description,
      "category_id" => $category_id,
      "category_name" => $category_name
    );

    array_push($productArr["records"], $product_item);
  }

  $totalRows = $product->count();
  $pageURL = "{$home_url}product/read_paging.php?";
  $productArr["paging"] = $utilities->getPaging($page, $totalRows, $recordsPage, $pageURL);

  http_response_code(200);
  echo json_encode($productArr);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Unable to read paging"));
}
?>