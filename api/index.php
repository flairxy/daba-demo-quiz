<?php

use Src\Quiz;

require "../start.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


if ($uri[1] !== 'quiz') {
  header("HTTP/1.1 404 Not Found");
  exit();
}


$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and post ID to the Post and process the HTTP request:
$controller = new Quiz($requestMethod);
$controller->processRequest();
