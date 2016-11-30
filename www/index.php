<?php
require("common.php");
if(!empty($_SESSION['user_name'])){
  header("Location: app.php");
  die("Welcome, redirecting to the julkl-app");
}
?>
<html>
<head>
  <title>julkl-app</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="centerparent">
  <div class="centerchild">
  <h2>Login</h2>
  <br>
  <form method="post" action="login.php?action=login" name="loginform">
    <input class="loginform" id="login_input_username" placeholder="Username or email" type="text" name="user_name" required />
    <input class="loginform" id="login_input_password" placeholder="Password" type="password" name="user_password" required />
    <br>
    <input type="submit"  name="login" value="Log in" />
  </form>
  <a href="register.php">Register new account</a>

  <?php
  if (isset($_GET["feedback"])) {
    echo "<br/><br/>" . $_GET["feedback"] . "<br/><br/>";
  }
  ?>
</div>
</body>
</html>
