<?php
class Utilities{
  public function getPaging($page, $total_rows, $recordsPage, $pageURL){
    $paging_arr = array();

    $paging_arr["first"] = $page > 1 ? "{$pageURL}page=1" : "";

    $totalPages = ceil($total_rows / $recordsPage);

    $range = 2;

    $initial_num = $page - $range;
    $conditionalLimitNum = ($page+$range) + 1;

    $paging_arr["pages"] = array();
    $pageCount = 0;

    for($x = $initial_num; $x < $conditionalLimitNum; $x++){
      if(($x > 0) && ($x <= $totalPages)){
        $paging_arr['pages'][$pageCount]["page"]=$x;
          $paging_arr['pages'][$pageCount]["url"]="{$pageURL}page={$x}";
          $paging_arr['pages'][$pageCount]["current_page"] = $x==$page ? "yes" : "no";
  
          $pageCount++;
      }
    }

    $paging_arr["last"] = $page<$totalPages ? "{$pageURL}page={$totalPages}" : "";

    return $paging_arr;
  }
}

?>
