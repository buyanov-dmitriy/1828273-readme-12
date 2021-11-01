<?php
date_default_timezone_set('Europe/Moscow');

/*$host = getenv('HOST_MYSQL');
$user = getenv('USER_MYSQL');
$password = getenv('PASSWORD_MYSQL');
$database = getenv('DATABASE_MYSQL');
$connect = connectToMySQL($host, $user, $password, $database);*/
$host = 'localhost';
$user = 'root';
$password = 'postdoc75';
$database = 'readme';
$connect = connectToMySQL($host, $user, $password, $database);
?>
