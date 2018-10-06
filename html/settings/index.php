<?php
require(__DIR__ . '/../../init.php');

$saved = "";

if (isset($_POST['save'])) {
  $_SESSION['playerSize'] = $_POST['playerSize'];
  $_SESSION['hideNoise'] = array_key_exists('hideNoise', $_POST);
  $saved = p('Your settings were modified!');
}

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
            lable('Player size: ') .
            select(
              option("Fill Screen", array(
                "value" => "fill",
                'selected' => playerSize() == 'fill')).
              option("Classic YouTube", array(
                'value' => "classic",
                'selected' => playerSize() == 'classic')).
              option("Theater Mode", array(
                'value' => "theater",
                'selected' => playerSize() == 'theater')),
              array("name" => "playerSize")
            ) . br() .
            lable('Hide noise: ') .
            checkbox(array(
              'name' => 'hideNoise',
              'checked' => hideNoise(),
            )) . br() .
            submit(array('value' => 'save', 'name' => 'save')) .
            $saved
          ))));
?>
