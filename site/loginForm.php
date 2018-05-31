<div id="validation-errors"></div>
<br>
<div id="registration">
  <form name="userLogin" action="login.php" onsubmit="return loginValidate();" method="POST">
    <?php
      require 'formGeneration.php';
      if (isset($errors)){
        echo '<div id="validation-errors">'.$errors.'</div>';
        input_field($errors, 'email', 'Email', 'email');
        password($errors, 'password', 'Password');
      } else {
        input_field('', 'email', 'Email', 'email');
        password('', 'password', 'Password');
      }
    ?>
      <input type="submit" value="Submit">
  </form>
</div>
