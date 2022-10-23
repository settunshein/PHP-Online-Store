<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'oknarsar');
define('DB_NAME', 'php_online_store');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS,  DB_NAME);
if(!$conn){
	die('Connection Failed:' . mysqli_connect_error());
}
// die('Connected Successfully');