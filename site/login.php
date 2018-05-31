<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php
    require 'formatting.php';
    require 'dbConnect.php';
    generateHead('Log In');
  ?>
  <body>
    <div id="wrapper">
      <?php
        generateHeader();
      ?>
      <div id="content">

        <div class="center-content-text">
          <?php
            if (isset($_POST['password']) && isset($_POST['email'])) {
              $hashed = hash('sha256', $_POST['password'].'plsGiveMarks');
              $email = $_POST['email'];
              $sql = "SELECT * FROM members WHERE email = '$email' AND hashedPassword = '$hashed';";
              $result = runSQL($sql);
              $success = false;
              if (!$result == "") {
                foreach ($result as $row){
                  $listing = $row;
                  $success = true;
                }
              }
              echo "<h1>Log In</h1><div class=\"break-line\"></div>";
              if ($success) {
                echo "Login Successful, redirecting home...";
                $_SESSION['signedIn'] = true;
                $_SESSION['userID'] = $listing['userID'];
                header( "refresh:1;url=index.php" );
              } else {
                echo '<div id="validation-errors">Invalid credentials!</div>';
                require 'loginForm.php';
              }
            } else {
              echo "<h1>Log In</h1><div class=\"break-line\"></div>";
              require 'loginForm.php';
            }
            ?>
        </div>
      </div>
    </div>
  </body>
</html>
