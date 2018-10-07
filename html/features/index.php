<?php
require(__DIR__ . '/../../init.php');

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
          h1(a('yt', array('href' => '../'))) .
          h2('hidden features') .
          div(
            p("You can remove most distractions from a video or playlist by changing the location of its URL to " . i('yt.dudzik.co') . ". For example, " . i('http://youtube.com/watch?v=xxx') . " becomes " . i('http://yt.dudzik.co/watch?v=xxx')) .
            p("You can also loop a video indefinitely by adding " . i('&loop=') . " to the end of a video URL " . i('http://yt.dudzik.co/watch?v=xxx&loop=')) .
            p("To quickly declutter a video you can prepend " . i('y.dudzik.co') ."  to a YouTube URL. Valid examples are: " . i('y.dudzik.co/http://youtube.com/watch?v=xxx&list=xxx') . br() . i('y.dudzik.co/v=xxx&ignores_params=xxx') . br() . i('y.dudzik.co/xxx')) .
            p("If you prefer using yt with https enabled you can browse it through " . a('https://dudzik.co/project/yt/', array('href' => 'https://dudzik.co/project/yt/')) . " otherwise you can use " . a('http://yt.dudzik.co', array('href' => 'http://yt.dudzik.co')))
            ))));
?>
