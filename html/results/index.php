<?php
require(__DIR__ . '/../../init.php');

function video_elment($href, $title, $thumbnail) {
  return li(a(h4($title) . img($thumbnail),
              array('href' => $href)));
}

function query_results($title, $query_results) {
  if(count($query_results) > 0) {
    $content = '';
    foreach ($query_results as $query_result) {
      $content .= video_elment($query_result['video_url'],
                               $query_result['title'],
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
  'h1 > a' => array(
   'color'           => 'inherit',
   'text-decoration' => 'inherit',
  ),
);

$autofocus = strlen($content) == 0;

if(!isset($_GET['search_query']) && strlen($content) == 0 && !isset($_GET['h'])) {
  $open_source = a('open source', array('href' => 'https://github.com/doodzik/yt'));
  $through_my_website = a('through my website', array('href' => 'https://dudzik.co'));
  $website_blocker = a('website blocker', array('href' => 'https://dudzik.co/about:blank/'));
  $hide_this_noise = a('hide this noise', array('href' => '/?h='));

  $content = p("") . $hide_this_noise . p ("yt is a distraction-free youtube client. It is $open_source and doesn't collect any data on you. You can remove most distractions from a video by changing the location of its URL to 'yt.dudzik.co'. For example, 'http://youtube.com/watch?v=xxx' becomes 'http://yt.dudzik.co/watch?v=xxx'. If you like yt you might like this $website_blocker I've built for Safari on iOS/macOS. You can reach out to me $through_my_website.");
}

$homeLink = isset($_GET['h']) ? '/?h=' : '/';

echo html(array(
      'head' =>
        title('yt') .
        style($style) .
        meta(array('charset' => "utf-8")) .
        meta(array('name' => "robots", 'content' => "index,follow")) .
        meta(array('name' => "keywords", 'content' => 'minimalist youtube, distraction-free youtube, minimal youtube, show only video youtube')) .
        meta(array('name' => "description", 'content' => "yt is a distraction-free youtube client. It is open source and doesn't collect any data on you. You can remove most distractions from a video by changing the location of its URL to 'yt.dudzik.co'. For example, 'http://youtube.com/watch?v=xxx' becomes 'http://yt.dudzik.co/watch?v=xxx'.")) .
        meta(array('name' => "author", 'content' => 'Frederik Dudzik - dudzik.co')) .
        meta(array('name' => "viewport", 'content' => 'width=device-width, initial-scale=1')),
      'body' =>
        content(
          h1(a('yt', array('href' => $homeLink))) .
          form('get',
            input_err($error, 'search_query') .
            input(array(
              'type' => 'text',
              'name' => 'search_query',
              'autofocus' => $autofocus,
            )) .
            submit(array('value' => 'search'))
          ) .
          div($content))));
?>
