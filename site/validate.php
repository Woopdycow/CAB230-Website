<?php
  // errors is passed by reference
  function validateName(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z\d]+$/';
    // include error based on failed criterion
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
      $errors = 'Name is empty.<br/>';
    }  else if (!preg_match($pattern, $field_list[$field_name])) {
      $errors = 'Name is invalid.<br/>';
    }
  }

  function validateTextArea(&$errors, $field_list) {
    $input = htmlspecialchars($field_list['text']);
    if (strlen($input > 255)) {
      $errors = "Review is too long.<br/>";
    }
  }

  function validateRating(&$errors, $field_list) {
    if (!isset($field_list['rating']) || empty($field_list['rating']) || $field_list['rating'] == ""){
      $errors = "Please provide a rating before submitting.<br/>";
    }
  }

  function validateEmail(&$errors, $field_list) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    $sql = "SELECT * FROM members WHERE email = '".$field_list['email']."';";
    $result = runSQL($sql);
    $row = getFirstRow($result);
    $original = true;
    if (!$row == ""){
      $original = false;
    }
    // include error based on failed criterion
    if (!isset($field_list['email']) || empty($field_list['email'])) {
      $errors = 'Email is empty.<br/>';
    } else if (!preg_match($pattern, $field_list['email'])) {
      $errors = 'Email is invalid.<br/>';
    } else if (!$original) {
      $errors = 'Account with email already exists.<br/>';
    }
  }

  function validatePassword(&$errors, $field_list) {
    if (!isset($field_list['password']) || empty($field_list['password'])) {
      $errors = 'Password is empty.<br/>';
    }
  }

  function validatePasswordConfirm(&$errors, $field_list) {
    if (!isset($field_list['passwordConfirm']) || empty($field_list['passwordConfirm'])) {
      $errors = 'Confirmation password is empty.<br/>';
    } else if ($field_list['passwordConfirm'] != $field_list["password"]) {
      $errors = 'Confirmation password does not match.<br/>';
    }
  }

  function validateDOB(&$errors, $field_list){
    $days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    if (!isset($field_list['day']) || empty($field_list['day'])) {
      $errors = 'Day is required.<br/>';
    } else if (!isset($field_list['month']) || empty($field_list['month'])) {
      $errors = 'Month is required.<br/>';
    } else if (!isset($field_list['year']) || empty($field_list['year'])) {
      $errors = 'Year is required.<br/>';
    } else if ($field_list['day'] < 0 || $field_list['day'] > 31) {
      $errors = 'Day is out of bounds.<br/>';
    } else if ($field_list['month'] < 0 || $field_list['month'] > 12) {
      $errors = 'Month is out of bounds.<br/>';
    } else if ($field_list['year'] < 1900 || $field_list['day'] > 2017) {
      $errors = 'Year is out of bounds.<br/>';
    }
  }

  function validateTOS(&$errors, $field_list){
    if (!isset($field_list['tos']) || empty($field_list['tos']) || $field_list['tos'] == 'Yes') {
      $errors = 'Please agree to the Terms and Conditions.<br/>';
    }
  }
?>
