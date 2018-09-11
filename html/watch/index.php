<?php
if(empty($_GET['v'])) {
  echo 'to redirect to a video please provide the v query parameter'; 
  die();
}

$id = $_GET['v'];
$url = "https://www.youtube.com/embed/$id?modestbranding=1&amp;rel=0";

header("Location: $url");
die();
?>
