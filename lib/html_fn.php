<?php
  require 'validators.php';

  function html($config) {
    $head = $config['head'];
    $body = $config['body'];
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

  function link2($config) {
    $link = "<link";
    foreach ($config as $key => $value) {
      $link .= " $key=\"$value\"";
    }
    return $link . '>';
  }

  function meta($config) {
    $meta = "<meta";
    foreach ($config as $key => $value) {
      $meta .= " $key=\"$value\"";
    }
    return $meta . '>';
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

  function i ($content) {
    return "<i>$content</i>";
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

  function a ($content, $config = array('href' => '#')) {
    $href = $config['href']; 
    return "<a href=\"$href\">$content</a>";
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

  function input ($config) {
    $type = $config['type'];
    $name = array_key_exists('name', $config) ? $config['name'] : '';
    $placeholder = array_key_exists('placeholder', $config) ? $config['placeholder'] : '';
    $autofocus = array_key_exists('autofocus', $config) ? $config['autofocus'] : false;

    if(strlen($name) == 0) {
      $name = $type;
    }
    if(strlen($placeholder) == 0) {
      $placeholder = str_replace("_"," ",$name);
    }

    $value = get_request($name);
    if ($autofocus) {
      $input = "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\" value=\"$value\" autofocus/>";
    } else {
      $input = "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\" value=\"$value\"/>";
    }
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

  function submit ($config) {
    $value = array_key_exists('value', $config) ? $config['value'] : 'Submit';
    $name = array_key_exists('name', $config) ? $config['name'] : false;
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
