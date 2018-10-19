<?php
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

?>
