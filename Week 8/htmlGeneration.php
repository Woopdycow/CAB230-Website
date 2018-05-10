<?php
function input_field($errors, $name, $label) {
  echo '<div class="required_field">';
  label($name, $label);
  if (isset($_POST["$name"])) {
    $value = ($_POST["$name"]);
  } else {
    $value = "";
  }
  echo "<input type=\"text\" id=\"$name\" name=\"$name\" value=\"$value\"/>";
  errorLabel($errors, $name);
  echo '</div>';
}

function password($errors, $name, $label) {
  echo '<div class="required_field">';
  label($name, $label);
  echo "<input type=\"password\" id=\"$name\" name=\"$name\" value=\"\"/>";
  errorLabel($errors, $name);
  echo '</div>';
}

function passwordConfirm($errors, $name, $label) {
  echo '<div class="required_field">';
  label($name, $label);
  echo "<input type=\"password\" id=\"$name\" name=\"$name\" value=\"\"/>";
  errorLabel($errors, $name);
  echo '</div>';
}

function label($name, $label) {
  echo "<label for=\"$name\">$label:</label>";
}

function errorLabel($errors, $name) {
  echo "<span id=\"$name" . "error\" class=\"error\">";
  if (isset($errors["$name"])) {
    echo $errors["$name"];
  }
  echo "</span>";
}
?>
