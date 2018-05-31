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
      <div id="content">
        <div class="center-content-text">
          <?php
              $sql = 'SELECT firstName FROM members WHERE userID = '.$_SESSION['userID'];
              $result = runSQL($sql);
              $row = getFirstRow($result);
              session_destroy();
              echo 'Thank you for your time <b>'.$row['firstName'].'.</b> Logging out and returning home...';
              header( "refresh:2;url=index.php" );
            ?>
        </div>
      </div>
    </div>
  </body>
</html>
