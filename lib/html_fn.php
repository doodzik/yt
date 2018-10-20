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

  function div ($content, $config = array()) {
    $values = '';
    $values = array_key_exists('class', $config) ? $values . 'class="' . $config['class'] .'"' : '';

    return "<div $values>$content</div>";
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

  function form ($content, $config = array()) {
    $request = array_key_exists('request', $config) ? $config['request'] : 'post';
    $path = array_key_exists('path', $config) ? $config['path'] : '';
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
    $values = '';
    $type = $config['type'];

    $autofocus = array_key_exists('autofocus', $config) ? $config['autofocus'] : false;
    $values = ($autofocus) ? $values . ' autofocus' : $values;

    $disabled = array_key_exists('disabled', $config) ? $config['disabled'] : false;
    $values = ($disabled) ? $values . ' disabled' : $values;

    $name = array_key_exists('name', $config) ? $config['name'] : '';
    if(strlen($name) == 0) {
      $name = $type;
    }
    $values = $values . ' name="' . $config['name'] . '"';

    $value = array_key_exists('value', $config) ? $config['value'] : get_request($name);
    $values = $values . "value=\"$value\"";

    $placeholder = array_key_exists('placeholder', $config) ? $config['placeholder'] : '';
    if(strlen($placeholder) == 0) {
      $placeholder = str_replace("_"," ",$name);
    }
    $values = $values . " placeholder=\"$placeholder\"";

    return "<input type=\"$type\" $values/>";
  }

  function select ($content, $config) {
    $name = $config['name'];
    return "<select name='$name'>$content</select>";
  }

  function option ($content, $config) {
    $values = '';
    $value = $config['value'];
    $values = "$values value='$value'";
    $selected = array_key_exists('selected', $config) ? $config['selected'] : false;
    $values = ($selected) ? $values . ' selected="selected"' : $values;
    return "<option $values>$content</option>";
  }

  function br () {
    return '</br>';
  }

  function checkbox ($config) {
    $name = $config['name'];
    $checked = array_key_exists('checked', $config) ? $config['checked'] : false;
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
    $values = '';
    $value = array_key_exists('value', $config) ? $config['value'] : 'Submit';
    $values = $values . "value=\"$value\"";
    $values = array_key_exists('name', $config) ? $values . ' name="' . $config['name'] . '"' : $values;
    $disabled = array_key_exists('disabled', $config) ? $config['disabled'] : false;
    $values = ($disabled) ? $values . ' disabled' : $values;
    return "<input type=\"submit\" $values>";
  }

  function nav ($content) {
    return "<nav>$content</nav>";
  }

  function iframe ($config) {
    $src = $config['src'];
    $values = '';
    $values = array_key_exists('src', $config) ? $values . ' src="' . $config['src'] . '"' : $values;
    $values = array_key_exists('frameborder', $config) ? $values . ' frameborder="' . $config['frameborder'] . '"' : $values;
    $values = array_key_exists('allowfullscreen', $config) ? $values . ' allowfullscreen="' . $config['allowfullscreen'] . '"' : $values;
    return "<iframe $values></iframe>";
  }

?>
