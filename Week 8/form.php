<!DOCTYPE>
<html>
  <head>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <form name="form1" action="processData.php" method="POST">
      <fieldset>
        <div class="required_field">
          <label for="firstname">First Name:</label>
          <input name="fname" id="firstname" type="text" value="<?php
          if(isset($_POST['fname'])) echo htmlspecialchars($_POST['fname']);
          ?>"/>
          <span id="firstnameError" class="error">
            <?php if (isset($errors['fname'])) echo $errors['fname'] ?>
          </span>
        </div>
        <div class="required_field">
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" value="<?php
          if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']);
          ?>"/>
          <span id="emailError" class="error">
            <?php if (isset($errors['email'])) echo $errors['email'] ?>
          </span>
        </div>
      </fieldset>
      State:<br>
      <select name="state" label="State:">
        <option value="qld">Queensland</label>
        <option value="nsw">New South Wales</label>
        <option value="vic">Victoria</label>
        <option value="act">Australian Capital Territory</label>
        <option value="tas">Tasmania</label>
        <option value="sa">South Australia</label>
        <option value="wa">Western Australia</label>
      </select><br>
      Level of Education:<br>
			<input type="radio" name="education" value="none" checked>None
			<input type="radio" name="education" value="highschool">Highschool
			<input type="radio" name="education" value="university">University<br>
      Password:<br>
			<input type="password" name="password" ><br>
			Confirm Password:<br>
			<input type="password" name="confirmPassword"><br><br>
      <input type="submit">
    </form>
  </body>
</html>
