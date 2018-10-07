<?php

$host = $_SERVER['HTTP_HOST'];

if(empty($_GET['data'])) {
  header("Location: http://$host");
  die();
}

$data = $_GET['data'];

if (isset($_GET['v']) && isset($_GET['list'])) {
  $v = $_GET['v'];
  $list = $_GET['list'];
  header("Location: http://$host/watch?v=$v&list=$list");
  die();
}

if (isset($_GET['v']) && empty($_GET['list'])) {
  $v = $_GET['v'];
  header("Location: http://$host/watch?v=$v");
  die();
}

if (empty($_GET['v']) && isset($_GET['list'])) {
  $list = $_GET['list'];
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
