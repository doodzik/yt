<?php
ini_set('session.cookie_httponly', true);
session_start();

require __DIR__ . '/../env.php';

if(getenv("PRODUCTION") == 'true') {
  if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    throw new \Exception('please run "composer install" in parent dir ' . __DIR__);
  }
  require_once __DIR__ . '/../vendor/autoload.php';
} else {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new \Exception('please run "composer install" in parent dir ' . __DIR__);
  }
  require_once __DIR__ . '/vendor/autoload.php';
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
  'input, select' => array(
    'font-size' => '16px',
  ),
  'h1 > a' => array(
    'color'           => 'inherit',
    'text-decoration' => 'inherit',
  ),
);

function playerSize() {
  return array_key_exists('playerSize', $_SESSION) ? $_SESSION['playerSize'] : 'classic';
}

function hideNoise() {
  return array_key_exists('hideNoise', $_SESSION) ? $_SESSION['hideNoise'] : false;
}

require('lib/youtube.php');
require('lib/html_fn.php');
?>
