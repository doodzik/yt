<?php
require(__DIR__ . '/../../init.php');

if(isset($_GET['list']) && empty($_GET['v'])) {
  $url = YouTube::playlist_url($_GET['list']);
  $title = YouTube::Instance()->titleForPlaylist($_GET['list']);
} else if(isset($_GET['list']) && isset($_GET['v'])) {
  $url = YouTube::playlist_url($_GET['list'], $_GET['v']);
  $title = YouTube::Instance()->titleForPlaylist($_GET['list']);
} else if(isset($_GET['v'])) {
  $url = YouTube::video_url($_GET['v'], isset($_GET['loop']));
  $title = YouTube::Instance()->titleForVideo($_GET['v']);
} else {
  echo 'please provide the v or/and list query parameter to watch a video';
  $title = '';
  die();
}

$style = array(
  'body' => array(
    'width' => '100vw',
    'height' => '100vh',
    'margin' => 0,
    'padding' => 0,
  ),
  'iframe' => array(
    'width' => '100%',
    'height' => '100%',
    'margin' => 0,
    'padding' => 0,
    'border' =>  0,
  ),
);

echo html(array(
      'head' =>
        title($title) .
        style($style) .
        link2(array('href' => "/favicon.ico", 'type' => "image/x-icon", 'rel' => "icon")) .
        meta(array('charset' => "utf-8")) .
        meta(array('name' => "robots", 'content' => "nofollow")) .
        meta(array('name' => "author", 'content' => 'Frederik Dudzik - dudzik.co')) .
        meta(array('name' => "viewport", 'content' => 'width=device-width, initial-scale=1')),
      'body' =>
        iframe(array('src' => $url, 'allowfullscreen' => 'allowfullscreen', 'frameborder' => 0))
      ));
?>
