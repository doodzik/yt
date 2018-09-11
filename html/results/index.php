<?php
require(__DIR__ . '/../../init.php');

function video_elment($href, $title, $thumbnail) {
  return li(a(h4($title) .
              img($thumbnail) ,
              $href));
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
$query_result = '';

if(isset($_GET['search_query'])) {
  if(strlen(validate_query($_GET['search_query'])) > 0) {
    $error['search_query'] = validate_query($_GET['search_query']);
  }

  if(count($error) == 0) {
    $result = YouTube::Instance()->query($_GET['search_query']);
    if (strlen($result['error']) == 0) {
      $query_result .= div(query_results('Videos', $result['videos']) .
                           query_results('Playlists', $result['playlists']));
    } else {
      $query_result .= $result['error'];
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
);

echo html(title('Tube') .
          style($style),
          content(
            h1('tube') .
            form('get',
              input_err($error, 'search_query') .
              input(array(
                'type' => 'text',
                'name' => 'search_query',
                'autofocus' => strlen($query_result) > 0,
              )) .
              submit('search')
            ) .
            div($query_result)));
?>
