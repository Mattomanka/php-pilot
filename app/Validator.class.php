<?php

class Validator {


  public function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }


  public function validateName($name) {
    $name = trim($name);
    print_r($this->date);
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $str = '/^[а-яА-ЯфёЁa-zA-Z0-9-_\.\s]{3,}/i';
    if (preg_match($str,$name)) {
      return true;
    } else {
      return false;
    }
  }


  public function validateSuccess($url,$data) {
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
      ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { print_r("ERROR!"); }

    return $result;
  }

}
