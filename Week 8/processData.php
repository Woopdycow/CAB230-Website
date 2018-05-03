<html>
  <?php
  $errors = array();
  if (isset($_POST['email'])) {
    require 'validate.php';
    validateEmail($errors, $_POST, 'email');
    if ($errors) {
      echo '<h1>Invalid, correct the following errors:</h1>';
      foreach ($errors as $field => $error) {
        echo "$field $error<br>";
      }
      // redisplay the form
      include 'Week 8.php';
    } else {
      echo 'form submitted successfully with no errors';
    }
  } else {
    include 'Week 8.php';
  }
  ?>
</html>
