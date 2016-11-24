<?php
require("common.php");
?>
<h2>Registration</h2>
<form method="post" action="login.php?action=register" name="registerform">
  <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
  <input id="login_input_username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
  <label for="login_input_email">User's email</label>
  <input id="login_input_email" type="email" name="user_email" required />
  <label for="login_input_password_new">Password (min. 6 characters)</label>
  <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
  <label for="login_input_password_repeat">Repeat password</label>
  <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
  <input type="submit" name="register" value="Register" />
</form>
<a href=".">Homepage</a>




<?php
   if (isset($_GET["feedback"])) {
     echo "<br/><br/>" . $_GET["feedback"] . "<br/><br/>";
   }
?>
