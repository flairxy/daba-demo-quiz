<?php

namespace Src;

class Quiz
{
  private $db;
  private $requestMethod;

  public function __construct($db, $requestMethod)
  {
    $this->db = $db;
    $this->requestMethod = $requestMethod;
  }

  public function processRequest()
  {
    switch ($this->requestMethod) {
      case 'GET':
        $response = $this->getQuiz();
        break;
      default:
        $response = $this->notFoundResponse();
        break;
    }
    header($response['status_code_header']);
    if ($response['body']) {
      echo $response['body'];
    }
  }
  private function getQuiz()
  {

    $file = "../quiz.csv";
    $csv = file_get_contents($file);
    $array = array_map("str_getcsv", explode("\n", $csv));
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $response['body'] = json_encode($array);
    return $response;
  }


  private function notFoundResponse()
  {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    return $response;
  }
}
