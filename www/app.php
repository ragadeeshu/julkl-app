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

  function fancyLoad(target){
    $('#content').animate({'opacity': 0}, 200, function () {
      $(this).load(target,function() {
        $(this).animate({'opacity': 1}, 200)});
      });
  }

  function fancyLoad(target, param){
    $('#content').animate({'opacity': 0}, 200, function () {
      $(this).load(target, param, function() {
        $(this).animate({'opacity': 1}, 200)});
      });
  }


  $(document).ready(function () {
    $('button#listbutton').on('click', function() {
      fancyLoad("editList.php");
    });
  });

  $(document).ajaxComplete(function(){
    $('button#savelist').on('click', function() {
      var list = {list_text:$('#mylist').val()};
      fancyLoad('editList.php', list);
    });
  });

  </script>

</head>
<body>
  <div class="header">
    <p style="float: left; width: 33.3%; text-align: left"><button id="listbutton">View your list</button></p>
    <p style="float: left; width: 33.3%; text-align: center;">julkl-app v0.1</p>
    <p style="float: left; width: 33.3%; text-align: right;"><a href="login.php?action=logout">Log out</a></p>
  </div>
  <div class="flex-container">
    <nav class="flex-list">
      Lists goes here.
    </nav>
    <div id="main" class="flex-content">
      <div id="content">
        Use the buttons on the page to start using the julkl-app.
      </div>
    </div>
  </div>
</body>
</html>
