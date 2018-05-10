<form name="form1" action="processData.php" method="POST">
  <fieldset>
    <?php
      require 'htmlGeneration.php';
      if (isset($errors)){
        input_field($errors, 'fname', 'First Name');
        input_field($errors, 'email', 'Email');
      } else {
        input_field('', 'fname', 'First Name');
        input_field('', 'email', 'Email');
      }
    ?>

    <label for="state">State:</label>
    <select name="state" label="State:">
      <option value="">Please Select State</label>
      <option value="qld">Queensland</label>
      <option value="nsw">New South Wales</label>
      <option value="vic">Victoria</label>
      <option value="act">Australian Capital Territory</label>
      <option value="tas">Tasmania</label>
      <option value="sa">South Australia</label>
      <option value="wa">Western Australia</label>
    </select><br>

    <label for="education">Level of Education:</label>
    <input type="radio" name="education" value="" checked>None
    <input type="radio" name="education" value="secondary">Secondary
    <input type="radio" name="education" value="tertiary">Tertiary<br>

    <?php
      if (isset($errors)){
        password($errors, 'password', 'Password');
        passwordConfirm($errors, 'confirmPassword', 'Confirm Password');
      } else {
        password('', 'password', 'Password');
        passwordConfirm('', 'confirmPassword', 'Confirm Password');
      }
    ?>

    <input type="submit">
  </fieldset>
</form>
