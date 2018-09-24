<?php
require(__DIR__ . '/../../init.php');

if (isset($_POST['save'])) {
  if (empty($_POST['video_width'])) {
    unset($_SESSION['video_width']);
  } else {
    $_SESSION['video_width'] = $_POST['video_width'];
  }

  if (empty($_POST['video_height'])) {
    unset($_SESSION['video_height']);
  } else {
    $_SESSION['video_height'] = $_POST['video_height'];
  }

  if (empty($_POST['video_margin'])) {
    unset($_SESSION['video_margin']);
  } else {
    $_SESSION['video_margin'] = $_POST['video_margin'];
  }
}

$width = array_key_exists('video_width', $_SESSION) ? $_SESSION['video_width'] : '';
$height = array_key_exists('video_height', $_SESSION) ? $_SESSION['video_height'] : '';
$margin = array_key_exists('video_margin', $_SESSION) ? $_SESSION['video_margin'] : '';

$style = array(
  'body' => array(
    'margin'      => '40px auto',
    'max-width'   => '650px',
    'line-height' => '1.5',
    'font-size'   => '18px',
    'color'       => '#444',
    'padding'     => '0 10px',
    'background'  => '#eee',
    'text-align'  => 'center',
  ),
  'input' => array(
    'font-size' => '16px',
  ),
);

echo html(array(
      'head' =>
        title('yt - settings') .
        style($style) .
        link2(array('href' => "/favicon.ico", 'type' => "image/x-icon", 'rel' => "icon")) .
        meta(array('charset' => "utf-8")) .
        meta(array('name' => "robots", 'content' => "index,follow")) .
        meta(array('name' => "keywords", 'content' => 'minimalist youtube, distraction-free youtube, minimal youtube, show only video youtube')) .
        meta(array('name' => "description", 'content' => "yt is a distraction-free youtube client. It is open source and doesn't collect any data on you. You can remove most distractions from a video by changing the location of its URL to 'yt.dudzik.co'. For example, 'http://youtube.com/watch?v=xxx' becomes 'http://yt.dudzik.co/watch?v=xxx'.")) .
        meta(array('name' => "author", 'content' => 'Frederik Dudzik - dudzik.co')) .
        meta(array('name' => "viewport", 'content' => 'width=device-width, initial-scale=1')),
      'body' =>
        content(
          h1(a('yt', array('href' => '/'))) .
          h2('settings') .
          p('This website uses cookies to save your settings.') .
          form('post',
            input(array(
              'type' => 'text',
              'name' => 'video height',
              'value' => $height,
            )) . br() .
            input(array(
              'type' => 'text',
              'name' => 'video width',
              'value' => $width,
            )) . br() .
            input(array(
              'type' => 'text',
              'name' => 'video margin',
              'value' => $margin,
            )) . br() .
            submit(array('value' => 'save', 'name' => 'save')) 
          ))));
?>

