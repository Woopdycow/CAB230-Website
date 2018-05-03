<?php
function validateEmail(&$errors, $field_list, $field_name) {
  $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
  if (!isset($field_list[$field_name])|| empty($field_list[$field_name])) {
    $errors[$field_name] = 'required';
  } else if (!preg_match($pattern, $field_list[$field_name])) {
    $errors[$field_name] = 'invalid';
  }
}

function input_field($errors, $name, $label) {
  echo '<div class="required_field">';
  label($name, $label);
  $value = posted_value($name);
  echo "<input type=\"text\" id=\"$name\" name=\"$name\" value=\"$value\"/>";
  errorLabel($errors, $name);
  echo '</div>';
}

function label($name, $label){
  echo "<label for=\"$name\">$label:</label>";
}

function errorLabel($errors, $name){
  echo "<span id=\"$nameError\" class='error'><?php if (isset($errors['$name'])) echo $errors['fname'] ?></span>";
}
?>
