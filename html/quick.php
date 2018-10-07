<?php

$host = $_SERVER['HTTP_HOST'];

if(empty($_GET['data'])) {
  header("Location: http://$host");
  die();
}

function getParamFromString($string, $key) {
  $position = strpos($string, $key);
  if ($position === false) {
    return false;
  }

  $ampersandPosition = strpos($string, '&', $position);
  $position = $position + strlen($key);
  if ($ampersandPosition === false) {
    return substr($string, $position);
  } else {
    return substr($string, $position, ($ampersandPosition - $position));
  }
}

$data = $_GET['data'];

$v = getParamFromString($data, 'v=');
$list = getParamFromString($data, 'list=');

if ($v !== false && $list !== false) {
  header("Location: http://$host/watch?v=$v&list=$list");
  die();
}

if ($v !== false && $list === false) {
  header("Location: http://$host/watch?v=$v");
  die();
}

if ($v === false && $list !== false) {
  header("Location: http://$host/watch?list=$list");
  die();
}

$ampersandPosition = strpos($data, '&');
if ($ampersandPosition !== false) {
  $data = substr($string, 0, $ampersandPosition);
}

header("Location: http://$host/watch?v=$data");
die();

?>
