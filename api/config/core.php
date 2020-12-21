<?php
ini_set('display_errors', 1);

$home_url = "127.0.0.1/api/";

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$recordsPage = 5;

$fromRecordNum = ($recordsPage * $page) - $recordsPage;
?>
