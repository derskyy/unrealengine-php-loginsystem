<?php

//Insert your DB Data here
$host = "localhost";
$user = "username";
$password = "safepassword";
$dbname = "yourdbname";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
