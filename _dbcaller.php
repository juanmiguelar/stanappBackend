<?php
require 'connector.php';
$dbcontroller = new DBController();

$response = $dbcontroller->runQuery("SELECT NOW();");

echo $response;

?>