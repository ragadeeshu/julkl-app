<?php
$db_type = "sqlite";
$db_path = "../julklapp.db";
try {
  //Connect to database
  $db = new PDO($db_type . ':' . $db_path);
}
catch(PDOException $ex) {
  // Failed to connect to database.
  die("Failed to connect to the database.");
}
//Setting pdo options
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Undo magic quotes.
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
  function undo_magic_quotes_gpc(&$array) {
    foreach($array as &$value) {
      if(is_array($value)) {
        undo_magic_quotes_gpc($value);
      } else {
        $value = stripslashes($value);
      }
    }
  }

  undo_magic_quotes_gpc($_POST);
  undo_magic_quotes_gpc($_GET);
  undo_magic_quotes_gpc($_COOKIE);
}
header('Content-Type: text/html; charset=utf-8');
if(session_status() == PHP_SESSION_NONE) session_start();
