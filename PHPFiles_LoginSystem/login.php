<?php

include 'config.php';

// is already logged in?
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  header("Location: dashboard.php");
  exit;
}


if (isset($_POST['email']) && isset($_POST['password'])) {
  // Get the email and password 
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Get the hashed password 
  $sql = "SELECT password FROM userdata WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];

    // Check if the password that the user entered in the login form matches 
    if (password_verify($password, $hashed_password)) {
      // The passwords match
      session_start();
      $_SESSION['logged_in'] = true;
      header("Location: dashboard.php");

      // Update the "online" status to 1
        $sql = "UPDATE userdata SET online=1 WHERE email='$email'";
        mysqli_query($conn, $sql);

        $_SESSION['email'] = $email;

    } else {
      // The passwords do not match
      $error_msg = "Incorrect email or password. Please try again.";
    }
  } else {
    // No user was found
    $error_msg = "Incorrect email or password. Please try again.";
  }
}

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
  <div class="registration-container">
    <div class="registration-box">
      <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="button-container">
            <input type="submit" value="Login">
            <input type="button" value="Register" onclick="window.location.href='register.php'" type="button">
        </div>
      </form>
      <?php if (isset($error_msg)) { ?>
        <p><?php echo $error_msg; ?></p>
      <?php } elseif (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
        <p>You are logged in. Welcome!</p>
      <?php } ?>
    </div>
  </div>
</body>
</html>
