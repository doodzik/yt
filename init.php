<?php
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new \Exception('please run "composer install" in parent dir ' . __DIR__);
}

require_once __DIR__ . '/vendor/autoload.php';

function is_production() {
  return getenv("PRODUCTION") !== false;
}

if(!is_production()) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
}

require('lib/youtube.php');
require('lib/html_fn.php');
?>
