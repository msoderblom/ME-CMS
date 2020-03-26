<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

/***127.0.0.1 */
$db_server = "localhost";
$db_database = "me_cms";
$db_username = "root";
$db_password = "";

try {
    $db = new PDO("mysql:host=$db_server;dbname=$db_database;charset=utf8", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected successfully";

} catch (PDOException $e) {
    echo $e->getMessage();
}