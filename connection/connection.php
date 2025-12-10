<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "apk_keamanan_lingkungan";

$koneksi = mysqli_connect(
   $hostname,
   $username,
   $password,
   $database_name
);

if ($koneksi->connect_error) {
   die("erorr!");
}
