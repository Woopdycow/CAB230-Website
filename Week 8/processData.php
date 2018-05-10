<html>
  <head>
  </head>
  <body>
    <?php
      $errors = array();
      if (isset($_POST['email'])) {
        require 'validate.php';
        validateEmail($errors, $_POST, 'email');
        validateFName($errors, $_POST, 'fname');
        validatePassword($errors, $_POST, 'password');
        validatePasswordConfirm($errors, $_POST, 'confirmPassword');
        if ($errors) {
          // redisplay the form
          include 'form.php';
        } else {
          echo 'form submitted successfully with no errors';
        }
      } else {
        include 'form.php';
      }
    ?>
  </body>
</html>
