<?php
require("common.php");
if(empty($_SESSION['user_name'])){
  header("Location: index.php?feedback=Log%20in%20first.");
  die("Log in first.");
}
?>
<html>
<head>
  <title>julkl-app</title>
  <meta charset="utf-8" />

  <link rel="stylesheet" type="text/css" href="style.css">

  <script src="http://code.jquery.com/jquery.min.js"></script>
  <script>

  function editList() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("main").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "editList.php", true);
    xhttp.send();
  }

  $(document).ready(function () {

  });
  </script>

</head>
<body>
  <div class="header">
    <p style="float: left; width: 33.3%; text-align: left"><input type=button value="View your list" onclick="editList()"></p>
    <p style="float: left; width: 33.3%; text-align: center;">julkl-app v0.1</p>
    <p style="float: left; width: 33.3%; text-align: right;"><a href="login.php?action=logout">Log out</a></p>
  </div>
  <div class="flex-container">
    <nav class="flex-list">
      Lists goes here.
    </nav>
    <div id="main" class="flex-content">
      Use the buttons on the page to start using the julkl-app.
    </div>
  </div>
</body>
</html>
