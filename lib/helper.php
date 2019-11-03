<?php
$style = array(
  '@media (prefers-color-scheme: light)' => array(
    'body' => array(
      'color'       => '#444',
      'background'  => '#eee',
    )
  ),
  '@media (prefers-color-scheme: dark)' => array(
    'body' => array(
      'color'       => '#FFFFFF',
      'background'  => '#161716',
    )
  ),
  'body' => array(
    'margin'      => '40px auto',
    'max-width'   => '650px',
    'line-height' => '1.5',
    'font-size'   => '18px',
    'padding'     => '0 10px',
    'text-align'  => 'center',
  ),
  'input, select' => array(
    'font-size' => '16px',
  ),
  'h1 > a' => array(
    'color'           => 'inherit',
    'text-decoration' => 'inherit',
  ),
);

function playerSize() {
  return array_key_exists('playerSize', $_COOKIE) ? $_COOKIE['playerSize'] : 'classic';
}

function hideNoise() {
  return array_key_exists('hideNoise', $_COOKIE) ? $_COOKIE['hideNoise'] : false;
}

function hideSearch() {
  return array_key_exists('hideSearch', $_COOKIE) ? $_COOKIE['hideSearch'] : false;
}

?>
