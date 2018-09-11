<?php
require(__DIR__ . '/../../init.php');

if(empty($_GET['v'])) {
  echo 'to redirect to a video please provide the v query parameter'; 
  die();
}

$url = YouTube::video_url($_GET['v']);

header("Location: $url");
die();
?>
