<?php
function input_field($errors, $name, $label, $type) {
  echo '<div class="required_field">';
  if (isset($_POST["$name"])) {
    $value = ($_POST["$name"]);
  } else {
    $value = "";
  }
  echo "<input type=\"$type\" id=\"$name\" name=\"$name\" value=\"$value\" placeholder=\"$label\"/>";
  echo '</div>';
}

function input_names($errors){
  if (isset($_POST["firstName"])) {
    $value1 = ($_POST["firstName"]);
  } else {
    $value1 = "";
  }

  if (isset($_POST["lastName"])) {
    $value2 = ($_POST["lastName"]);
  } else {
    $value2 = "";
  }

  echo "<div class=\"required_field\">
    <input type=\"text\" id=\"firstName\" name=\"firstName\" value=\"$value1\" placeholder=\"First Name\" pattern=\"[a-zA-Z]*\"/>
    <input type=\"text\" id=\"lastName\" name=\"lastName\" value=\"$value2\" placeholder=\"Last Name\" pattern=\"[a-zA-Z]*\"/>
    </div>";
}

function input_dob($errors){
  echo '<div class="required_field">';
  if (isset($_POST["day"])) {
    $value = ($_POST["day"]);
  } else {
    $value = "";
  }
  echo "<input type=\"number\" id=\"day\" name=\"day\" value=\"$value\" placeholder=\"DD\"/>";
  if (isset($_POST["month"])) {
    $value = ($_POST["month"]);
  } else {
    $value = "";
  }
  echo "<input type=\"number\" id=\"month\" name=\"month\" value=\"$value\" placeholder=\"MM\"/>";
  if (isset($_POST["year"])) {
    $value = ($_POST["year"]);
  } else {
    $value = "";
  }
  echo "<input type=\"number\" id=\"year\" name=\"year\" value=\"$value\" placeholder=\"YYYY\"/>";
  echo '</div>';
  //errors
  echo "<span id=\"dob" . "error\" class=\"error\">";
  if (isset($errors["year"])) {
    echo $errors["year"];
  }
  echo "</span>";
}

function input_tos($errors){
  echo "<br><input type=\"checkbox\" id=\"tos\" name=\"tos\">I accept the <a href=\"#\"><b>Terms and Conditions</b></a></input><br>";
}

function password($errors, $name, $label) {
  echo '<div class="required_field">';
  echo "<input type=\"password\" id=\"$name\" name=\"$name\" placeholder=\"$label\" value=\"\"/>";
  echo '</div>';
}

function passwordConfirm($errors, $name, $label) {
  echo '<div class="required_field">';
  echo "<input type=\"password\" id=\"$name\" name=\"$name\" placeholder=\"$label\" value=\"\"/>";
  echo '</div>';
}

?>
