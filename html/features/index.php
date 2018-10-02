<?php
require(__DIR__ . '/../../init.php');

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
  'ul' => array(
    'padding'         => '0',
    'list-style-type' => 'none',
  ),
  'li' => array(
    'padding-bottom' => '30px',
  ),
  'h1 > a' => array(
   'color'           => 'inherit',
   'text-decoration' => 'inherit',
  ),
);

echo html(array(
      'head' =>
        title('yt - distraction-free youtube') .
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
          h2('hidden features') .
          div(
            p("You can remove most distractions from a video or playlist by changing the location of its URL to " . i('yt.dudzik.co') . ". For example, " . i('http://youtube.com/watch?v=xxx') . " becomes " . i('http://yt.dudzik.co/watch?v=xxx') . ".") .
            p("You can also loop a video indefinitely by adding " . i('&loop=') . " to the end of a video URL " . i('http://yt.dudzik.co/watch?v=xxx&loop=') . ".")
            ))));
?>

