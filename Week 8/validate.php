<?php
  // errors is passed by reference
  function validateEmail(&$errors, $field_list, $field_name) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    // include error based on failed criterion
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
      $errors[$field_name] = 'Required';
    } else if (!preg_match($pattern, $field_list[$field_name])) {
      $errors[$field_name] = 'Invalid';
    }
  }

  function validateFName(&$errors, $field_list, $field_name) {
    // include error based on failed criterion
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
      $errors[$field_name] = 'Required';
    }
  }

  function validatePassword(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
      $errors[$field_name] = 'Required';
    }
  }

  function validatePasswordConfirm(&$errors, $field_list, $field_name) {
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name])) {
      $errors[$field_name] = 'Required';
    } else if ($field_list[$field_name] != $field_list["password"]) {
      $errors[$field_name] = 'Does Not Match';
    }
  }
?>
