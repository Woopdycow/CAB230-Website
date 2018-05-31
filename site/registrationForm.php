<div id="validation-errors"></div>
<br>
<div id="registration">
  <form name="userRegistration" action="" onsubmit="return registrationValidate();" method="POST">
    <?php
      require 'formGeneration.php';
      if (isset($errors)){
        input_names($errors);
        input_field($errors, 'email', 'Email', 'email');
        password($errors, 'password', 'Password');
        passwordConfirm($errors, 'passwordConfirm', 'Confirm Password');
        echo '<h3>Date of Birth</h3>';
        input_dob($errors);
        input_tos($errors);
      } else {
        input_names('');
        input_field('', 'email', 'Email', 'email');
        password('', 'password', 'Password');
        passwordConfirm('', 'passwordConfirm', 'Confirm Password');
        echo '<h3>Date of Birth</h3>';
        input_dob('');
        input_tos('');
      }
    ?>
    <input type="submit" value="Submit">
  </form>
</div>
