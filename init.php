<?php

require __DIR__ . '/../env.php';

if(getenv("PRODUCTION") == 'true') {
  print_r(gettype(getenv("PRODUCTION")));
  print_r(getenv("PRODUCTION"));
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

require('lib/youtube.php');
require('lib/html_fn.php');
?>
