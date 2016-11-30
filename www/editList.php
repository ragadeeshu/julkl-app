<?php
require("common.php");
if(empty($_SESSION['user_name'])){
  header("Location: index.php?feedback=Log%20in%20first.");
  die("Log in first.");
}
$sql = 'SELECT list_id, list_text
FROM lists
WHERE user_id = :user_id';
$query = $db->prepare($sql);
$query->bindValue(':user_id', $_SESSION['user_id']);
$query->execute();
$result_row = $query->fetch();
error_log($result_row);
if ($result_row) {
  ?>
  
  <?php
} else {
  $list_sql = 'INSERT INTO lists (user_id, list_text)
  VALUES(:user_id, :list_text)';
  $query = $db->prepare($list_sql);
  $query->bindValue(':user_id', $_SESSION['user_id']);
  $query->bindValue(':list_text', "");
  $success = $query->execute();
  if( $success ){
    include("editList.php");
  } else {
    echo "Shit hit the fan.";
  }
}
?>
