<?php

include 'config.php';

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  header("Location: dashboard.php");
  exit;
}
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if  form has been submitted
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
    // Get the email, password, and username
    $email = $_POST['email'];
    $plaintext_password = $_POST['password'];
    $username = $_POST['username'];

    // Check if the email is already used
    $stmt = mysqli_prepare($conn, "SELECT * FROM userdata WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        // Email is already in use
        $error_msg = "This email is already in use. Please try a different email.";
    } else {
        // Email is not in use, so check if the username
        $stmt = mysqli_prepare($conn, "SELECT * FROM userdata WHERE username=?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            // Username is already in use
            $error_msg = "This username is already in use. Please try a different username.";
        } else {
            // Email and username are not in use,  hash the password
            $hashed_password = password_hash($plaintext_password, PASSWORD_BCRYPT);

            // Insert the new user in DB
            $stmt = mysqli_prepare($conn, "INSERT INTO userdata (email, password, username) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $username);
            if (mysqli_stmt_execute($stmt)) {
                // Success!
                // Insert the new player into the playerdata table
                $stmt = mysqli_prepare($conn, "INSERT INTO playerdata (playerid) VALUES (?)");
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                header("Location: login.php");
            } else {
                // Error while inserting
                $error_msg = "An error occurred while registering. Please try again later. MySQL error: " . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
  <div class="registration-container">
    <div class="registration-box">
      <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" oninput="checkPasswordStrength()">
        <div id="password-strength-message"></div>
        <input type="submit" value="Register">
      </form>
      <br><br>
      <a href="login.php">Already have an account? Click here to login.</a>
      <?php if (isset($error_msg)) { ?>
        <p><?php echo $error_msg; ?></p>
      <?php } ?>
    </div>
  </div>
</body>
</html>

<script>
function checkPasswordStrength() {

  var password = document.getElementById("password").value;

  // Check the length
  if (password.length < 8) {
    document.getElementById("password-strength-message").innerHTML = "Weak (must be at least 8 characters long)";
    return;
  }

  // Check if the password is strong enough
  if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
    document.getElementById("password-strength-message").innerHTML = "Weak (must contain at least one lowercase letter, one uppercase letter, and one number)";
    return;
  }

  // If the password passes, display msg
  document.getElementById("password-strength-message").innerHTML = "Strong";
}
</script>