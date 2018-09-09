<?php 
  function validate_email($email) {
    $value = '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      $value = 'email is invalid';
    return $value;
  }

  function validate_query($name) {
    if(strlen($name) == 0) {
      return 'query cannot be empty';
    }
    return '';
  }
?>
