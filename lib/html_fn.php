<?php
  require 'validators.php';

  function html($head, $body) {
    return "<!DOCTYPE html>
            <html>
              <head>
                $head
              </head>
              <body>
                $body
              </body>
            </html>";
  }

  function style($styles) {
    $content = '';
    foreach ($styles as $selector => $rules) {
      $rule_body = '';
      foreach ($rules as $rule => $rule_value) {
        $rule_body .= "$rule:$rule_value;";
      }
      $rule_body = substr($rule_body, 0, -1);
      $content .= $selector. '{' . $rule_body .'}';
      $rule_body = '';
    }
    return "<style>$content</style>";
  }

  function title ($name) {
    return "<title>$name</title>";
  }

  function content ($content) {
    return "<div id=\"content\">$content</div>";
  }

  function div ($content) {
    return "<div>$content</div>";
  }

  function p ($content) {
    return "<p>$content</p>";
  }

  function ul ($content) {
    return "<ul>$content</ul>";
  }

  function li ($content) {
    return "<li>$content</li>";
  }

  function h1 ($content) {
    return "<h1>$content</h1>";
  }

  function h2 ($content) {
    return "<h2>$content</h2>";
  }

  function h3 ($content) {
    return "<h3>$content</h3>";
  }

  function h4 ($content) {
    return "<h4>$content</h4>";
  }

  function a ($content, $link = '#') {
    return "<a href=\"$link\">$content</a>";
  }

  function img ($src) {
    return "<img src='$src' />";
  }

  function form ($request, $content) {
    // automatically sets the filename as the action path
    $backtrace = debug_backtrace();
    $str  = $backtrace[0]['file'];
    $path = substr(strstr($str, 'html/'), 4);
    $path = str_replace('/index.php', '', $path);
    return "<form action=\"$path\" method=\"$request\">$content</form>";
  }

  function lable ($value, $class = '') {
      if(strlen($class) > 0)
        $class = "class=\"$class\"";
      return "<lable $class >$value</lable>";
  }

  function input_err ($error, $name) {
    if(isset($error[$name])) {
      $err_val = $error[$name];
      return lable($err_val, 'error') . br();
    }

    return '';
  }

  function get_request($name) {
    $value = '';
    if(isset($_POST[$name]))
      $value = $_POST[$name];
    if(isset($_GET[$name]))
      $value = $_GET[$name];
    return $value;
  }

  function input ($type, $name = '', $placeholder = '') {
    if(strlen($name) == 0) {
      $name = $type;
    }
    if(strlen($placeholder) == 0) {
      $placeholder = str_replace("_"," ",$name);
    }

    $value = get_request($name);
    $input = "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\" value=\"$value\"/>";
    return $input;
  }

  function br () {
    return '</br>';
  }

  function checkbox ($name, $checked = true) {
    $checked = ($checked) ? 'checked' : '';
    return "<input type=\"checkbox\" name=\"$name\" $checked/>";
  }

  function checkbox_array ($name, $value, $checked = false) {
    $checked = ($checked) ? 'checked' : '';
    $name .= '[]';
    return "<input type=\"checkbox\" name=\"$name\" value=\"$value\" $checked/>";
  }

  function text ($name ='', $placeholder = '') {
    return input('text', $name, $placeholder);
  }

  function hidden($field, $value) {
    return "<input type=\"hidden\" name=\"$field\" value=\"$value\">";
  }

  function submit ($value = 'Submit', $name=false) {
    if (!$name) {
      return "<input type=\"submit\" value=\"$value\">";
    } else {
      return "<input type=\"submit\" name=\"submit\" value=\"$value\">";
    }
  }

  function nav ($content) {
    return "<nav>$content</nav>";
  }

?>
