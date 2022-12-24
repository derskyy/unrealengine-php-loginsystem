<?php

session_start();

include 'config.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  $email = $_SESSION['email'];

  $stmt = mysqli_prepare($conn, "UPDATE userdata SET online=0 WHERE email=?");
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  session_destroy();
  header("Location: login.php");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
