<?php
require(__DIR__ . '/../../init.php');

function video_elment($href, $title, $thumbnail) {
  return li(a(img($thumbnail) . h4($title),
              array('href' => $href)));
}

function query_results($title, $query_results) {
  if(count($query_results) > 0) {
    $content = '';
    foreach ($query_results as $query_result) {
      $content .= video_elment($query_result['video_url'],
                               mb_strtolower($query_result['title'],'UTF-8'),
                               $query_result['thumbnail']);
    }
    return h3($title) . ul($content);
  } else {
    return h3($title) . ul(li('no results'));
  }
}

$error = array();
$content = '';

if(isset($_GET['search_query'])) {
  if(strlen(validate_query($_GET['search_query'])) > 0) {
    $error['search_query'] = validate_query($_GET['search_query']);
  }

  if(count($error) == 0) {
    $result = YouTube::Instance()->query($_GET['search_query']);
    if (strlen($result['error']) == 0) {
      $content .= div(query_results('Videos', $result['videos']) .
                      query_results('Playlists', $result['playlists']));
    } else {
      $content .= $result['error'];
    }
  }
}

$style['ul'] = array(
  'padding'         => '0',
  'list-style-type' => 'none',
);
$style['li'] = array(
  'padding-bottom' => '30px',
);

$autofocus = strlen($content) == 0;
$settings = a('settings', array('href' => './settings'));

if (hideSearch()) {
  $content = p("You disabled the search feature in $settings");
}

if(!isset($_GET['search_query']) && strlen($content) == 0) {
  $content = p('') . $settings;
  if (hideNoise()) {

  } else {
    $open_source = a('open source', array('href' => 'https://github.com/doodzik/yt'));
    $Ive = a("I've", array('href' => 'https://dudzik.co'));
    $website_blocker = a('website blocker', array('href' => 'https://dudzik.co/about:blank/'));
    $hidden_features = a('hidden features', array('href' => './features'));

    $content .= p("yt is an distraction-free youtube client. It is $open_source and doesn't collect your data. It has a couple of $hidden_features and if you like yt you might find this $website_blocker $Ive built for Safari on iOS and macOS useful as well.");
  }
}

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
          h1(a('yt', array('href' => './'))) .
          form(input_err($error, 'search_query') .
               input(array(
                 'type' => 'text',
                 'name' => 'search_query',
                 'autofocus' => $autofocus,
                 'disabled' => hideSearch(),
               )) .
              submit(array('value' => 'search', 'disabled' => hideSearch())),
              array('request' => 'get')
          ) .
          div($content))));
?>
