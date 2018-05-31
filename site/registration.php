<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php
    require 'formatting.php';
    require 'dbConnect.php';
    generateHead('Registration');
  ?>
  <body>
    <div id="wrapper">
      <?php
        generateHeader();
      ?>
      <div id="content">
        <div class="center-content-text">
            <?php
              $errors = "";
              if (isset($_POST['day'])){
                echo "<h1>Registration</h1>
                  <div class=\"break-line\"></div>
                  After signing up, you will be able to leave
                  reviews on the many hotspots around brisbane.
                  <div class=\"break-line\"></div>";
                require 'validate.php';
                validateName($errors, $_POST, 'firstName');
                validateName($errors, $_POST, 'lastName');
                validateEmail($errors, $_POST);
                validatePassword($errors, $_POST);
                validatePasswordConfirm($errors, $_POST);
                validateDOB($errors, $_POST);
                validateTOS($errors, $_POST);
                if ($errors != "") {
                  echo '<div id="validation-errors">'.$errors.'</div>';
                  require 'registrationForm.php';
                } else {
                  $formattedDOB = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
                  $hashed = hash('sha256', $_POST['password'].'plsGiveMarks');
                  $sql = "INSERT INTO members (firstName, lastName, email, dob, hashedPassword) VALUES ('".$_POST['firstName']."', '".$_POST['lastName']."', '".$_POST['email']."', '".$formattedDOB."', '".$hashed."');";
                  $result = runSQL($sql);
                  echo 'Registration successful, redirecting...<br/>';
                  header( "refresh:2;url=index.php" );
                }
              } else {
                echo "<h1>Registration</h1>
                  <div class=\"break-line\"></div>
                  After signing up, you will be able to leave
                  reviews on the many hotspots around brisbane.
                  <div class=\"break-line\"></div>";
                require 'registrationForm.php';
              }
            ?>
        </div>
      </div>
    <?php
      generateFooter();
    ?>
    </div>
  </body>
</html>
