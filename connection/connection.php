<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "apk_keamanan_lingkungan";

$db = mysqli_connect(
   $hostname,
   $username,
   $password,
   $database_name
);

if ($db->connect_error) {
   die("erorr!");
}
