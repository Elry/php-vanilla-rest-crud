<?php
class Utilities{
  public function getPaging($page, $totalRows, $recordsPage, $pageURL){
    $pagingArr = array();

    $pagingArr["first"] = $page > 1 ? "{$pageURL}page=1" : "";

    $totalPages = ceil($totalRows / $recordsPage);

    $range = 2;

    $initialNum = $page - $range;
    $conditionalLimitNum = ($page+$range) + 1;

    $pagingArr["pages"] = array();
    $pageCount = 0;

    for($x = $initialNum; $x < $conditionalLimitNum; $x++){
      if(($x > 0) && ($x <= $totalPages)){
        $pagingArr['pages'][$pageCount]["page"]=$x;
          $pagingArr['pages'][$pageCount]["url"]="{$pageURL}page={$x}";
          $pagingArr['pages'][$pageCount]["current_page"] = $x==$page ? "yes" : "no";
  
          $pageCount++;
      }
    }

    $pagingArr["last"] = $page<$totalPages ? "{$pageURL}page={$totalPages}" : "";

    return $pagingArr;
  }

  public function getHttpStatusMessage($statusCode){
    $statusMessages = array(
      100 => 'Continue',  
      101 => 'Switching Protocols',  
      200 => 'OK',
      201 => 'Created',  
      202 => 'Accepted',  
      203 => 'Non-Authoritative Information',  
      204 => 'No Content',  
      205 => 'Reset Content',  
      206 => 'Partial Content',  
      300 => 'Multiple Choices',  
      301 => 'Moved Permanently',  
      302 => 'Found',  
      303 => 'See Other',  
      304 => 'Not Modified',  
      305 => 'Use Proxy',  
      306 => '(Unused)',  
      307 => 'Temporary Redirect',  
      400 => 'Bad Request',  
      401 => 'Unauthorized',  
      402 => 'Payment Required',  
      403 => 'Forbidden',  
      404 => 'Not Found',  
      405 => 'Method Not Allowed',  
      406 => 'Not Acceptable',  
      407 => 'Proxy Authentication Required',  
      408 => 'Request Timeout',  
      409 => 'Conflict',  
      410 => 'Gone',  
      411 => 'Length Required',  
      412 => 'Precondition Failed',  
      413 => 'Request Entity Too Large',  
      414 => 'Request-URI Too Long',  
      415 => 'Unsupported Media Type',  
      416 => 'Requested Range Not Satisfiable',  
      417 => 'Expectation Failed',  
      500 => 'Internal Server Error',  
      501 => 'Not Implemented',  
      502 => 'Bad Gateway',  
      503 => 'Service Unavailable',  
      504 => 'Gateway Timeout',  
      505 => 'HTTP Version Not Supported'
    );
    return ($statusMessages[$statusCode]) ? $statusMessages[$statusCode] : $statusMessages[500];
  }
}

?>
