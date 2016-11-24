<?php
/**
 * This file creates a sqlite database for the julk-app to use.
 * Run once with `php install.php`
 */
error_reporting(E_ALL);
$db_type = "sqlite";
$db_path = "../julklapp.db";
$db_connection = new PDO($db_type . ':' . $db_path);
$sql_users = 'CREATE TABLE IF NOT EXISTS `users` (
        `user_id` INTEGER PRIMARY KEY,
        `user_password_hash` varchar(255),
        `user_name` varchar(64),
        `user_email` varchar(64));
        CREATE UNIQUE INDEX `user_email_UNIQUE` ON `users` (`user_email` ASC);
        CREATE UNIQUE INDEX `user_name_UNIQUE` ON `users` (`user_name` ASC);
        ';
$sql_messages = 'CREATE TABLE IF NOT EXISTS `messages` (
        `message_id` INTEGER PRIMARY KEY,
        `user_id` INTEGER,
        `poster_id` INTEGER,
        `message_text` TEXT,
        FOREIGN KEY(user_id) REFERENCES users(user_id),
        FOREIGN KEY(poster_id) REFERENCES users(user_id));
        ';
$sql_lists = 'CREATE TABLE IF NOT EXISTS `lists` (
        `list_id` INTEGER PRIMARY KEY,
        `user_id` INTEGER,
        `list_text` TEXT,
        FOREIGN KEY(user_id) REFERENCES users(user_id));
        ';

try
{
  $query = $db_connection->prepare($sql_users);
  $query->execute();
  $query = $db_connection->prepare($sql_messages);
  $query->execute();
  $query = $db_connection->prepare($sql_lists);
  $query->execute();
}
catch(Exception $e)
{
  echo "Error creating database!";
}
