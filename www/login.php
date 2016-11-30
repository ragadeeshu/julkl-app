<?php
require("common.php");

$feedback = "";
if (isset($_GET["action"]) && $_GET["action"] == "register") {
  doRegistration();
  header("Location: index.php?feedback=$feedback");
  die("Registration done");
} else if (isset($_GET["action"]) && $_GET["action"] == "logout") {
  $_SESSION = array();
  session_destroy();
  $feedback = "You were just logged out.";
} else if (isset($_GET["action"]) && $_GET["action"] == "login") {
  performUserLoginAction();
  if(!empty($_SESSION['user_name'])){
    header("Location: app.php");
    die("Welcome, redirecting to the julkl-app");
  }
}
header("Location: index.php?feedback=$feedback");
die("Log in failed.");

function performUserLoginAction()
{
  global $feedback;
  global $db;
  if (isset($_POST["login"])) {
    if (checkLoginFormDataNotEmpty()) {
      $sql = 'SELECT user_name, user_email, user_id, user_password_hash
      FROM users
      WHERE user_name = :user_name OR user_email = :user_name';
      $query = $db->prepare($sql);
      $query->bindValue(':user_name', $_POST['user_name']);
      $query->execute();
      $result_row = $query->fetch();
      if ($result_row) {
        if (password_verify($_POST['user_password'], $result_row['user_password_hash'])) {
          $_SESSION['user_name'] = $result_row['user_name'];
          $_SESSION['user_id'] = $result_row['user_id'];
          $_SESSION['user_email'] = $result_row['user_email'];
          return true;
        } else {
          $feedback = "Wrong password.";
        }
      } else {
        $feedback = "This user does not exist.";
      }
      return false;
    }
  }
}

function doRegistration()
{
  global $feedback;
  global $db;
  if (checkRegistrationData()) {
    $user_name = htmlentities($_POST['user_name'], ENT_QUOTES);
    $user_email = htmlentities($_POST['user_email'], ENT_QUOTES);
    $user_password = $_POST['user_password_new'];
    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
    $sql = 'SELECT * FROM users WHERE user_name = :user_name OR user_email = :user_email';
    $query = $db->prepare($sql);
    $query->bindValue(':user_name', $user_name);
    $query->bindValue(':user_email', $user_email);
    $query->execute();
    $result_row = $query->fetch();
    if ($result_row) {
      $feedback = "Sorry, that username / email is already taken. Please choose another one.";
    } else {
      $sql = 'INSERT INTO users (user_name, user_password_hash, user_email)
      VALUES(:user_name, :user_password_hash, :user_email)';
      $query = $db->prepare($sql);
      $query->bindValue(':user_name', $user_name);
      $query->bindValue(':user_password_hash', $user_password_hash);
      $query->bindValue(':user_email', $user_email);
      $registration_success_state = $query->execute();
      if ($registration_success_state) {
        $feedback = "Your account has been created successfully. You can now log in.";
        return true;
      } else {
        $feedback = "Sorry, your registration failed. Please go back and try again.";
      }
    }
  }
  return false;
}

function checkLoginFormDataNotEmpty()
{
  global $feedback;
  if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
    return true;
  } elseif (empty($_POST['user_name'])) {
    $feedback = "Username field was empty.";
  } elseif (empty($_POST['user_password'])) {
    $feedback = "Password field was empty.";
  }
  return false;
}

function checkRegistrationData()
{
  global $feedback;
  if (!isset($_POST["register"])) {
    return false;
  }
  if (!empty($_POST['user_name'])
  && strlen($_POST['user_name']) <= 64
  && strlen($_POST['user_name']) >= 2
  && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
  && !empty($_POST['user_email'])
  && strlen($_POST['user_email']) <= 64
  && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
  && !empty($_POST['user_password_new'])
  && strlen($_POST['user_password_new']) >= 6
  && !empty($_POST['user_password_repeat'])
  && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
  ) {
    return true;
  } elseif (empty($_POST['user_name'])) {
    $feedback = "Empty Username";
  } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
    $feedback = "Empty Password";
  } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
    $feedback = "Password and password repeat are not the same";
  } elseif (strlen($_POST['user_password_new']) < 6) {
    $feedback = "Password has a minimum length of 6 characters";
  } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
    $feedback = "Username cannot be shorter than 2 or longer than 64 characters";
  } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
    $feedback = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
  } elseif (empty($_POST['user_email'])) {
    $feedback = "Email cannot be empty";
  } elseif (strlen($_POST['user_email']) > 64) {
    $feedback = "Email cannot be longer than 64 characters";
  } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $feedback = "Your email address is not in a valid email format";
  } else {
    $feedback = "An unknown error occurred.";
  }
  return false;
}
