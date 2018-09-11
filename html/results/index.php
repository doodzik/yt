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

if(strlen($content) == 0) {
}

echo html(title('yt') .
          style($style),
          content(
            h1(a('yt', array('href' => '/'))) .
            form('get',
              input_err($error, 'search_query') .
              input(array(
                'type' => 'text',
                'name' => 'search_query',
                'autofocus' => $autofocus,
              )) .
              submit(array('value' => 'search'))
            ) .
            div($content)));
?>
