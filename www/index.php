<?php
require("common.php");
?>
<h2>Login</h2>
<form method="post" action="login.php?action=login" name="loginform">
  <label for="login_input_username">Username (or email)</label>
  <input id="login_input_username" type="text" name="user_name" required />
  <label for="login_input_password">Password</label>
  <input id="login_input_password" type="password" name="user_password" required />
  <input type="submit"  name="login" value="Log in" />
</form>
<a href="register.php">Register new account</a>


<?php
   if (isset($_GET["feedback"])) {
     echo "<br/><br/>" . $_GET["feedback"] . "<br/><br/>";
   }
?>
