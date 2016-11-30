<?php
require("common.php");
?>
<html>
<head>
  <title>julkl-app</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="centerparent">
  <div class="centerchild">
  <h2>Registration</h2>
  <form method="post" action="login.php?action=register" name="registerform">
    <br>
    <input class="loginform" placeholder="Username" id="login_input_username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    <br>
    <input class="loginform" placeholder="Email" id="login_input_email" type="email" name="user_email" required />
    <br>
    <input class="loginform" placeholder="Password" id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    <br>
    <input class="loginform" placeholder="Password again" id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <input type="submit" name="register" value="Register" />
  </form>
  <a href=".">Homepage</a>
  <?php
  if (isset($_GET["feedback"])) {
    echo "<br/><br/>" . $_GET["feedback"] . "<br/><br/>";
  }
  ?>
</div>
</body>
</html>
