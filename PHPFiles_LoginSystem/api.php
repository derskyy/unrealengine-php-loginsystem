<?php

session_start();

include 'config.php';

// LOGIN
function login($email, $password) {
 
  global $conn;

  // Check if the user is already logged in
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    return array('status' => 'error', 'message' => 'Already logged in');
  }

  // Get the username and hashed password
  $sql = "SELECT username, password FROM userdata WHERE email='$email'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $hashed_password = $row['password'];

    // Check passwords - pw vs. hashed
    if (password_verify($password, $hashed_password)) {
        // Password approved
        $_SESSION['logged_in'] = true;
        // Set Online to 1
        $sql = "UPDATE userdata SET online=1 WHERE email='$email'";
        mysqli_query($conn, $sql);
      
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        // Return success
        return array('status' => 'success', 'username' => $username, 'email' => $email);
      } else {
        // The passwords do not match
        return array('status' => 'error', 'message' => 'Incorrect email or password');
      }
      
    } else {
      // No user was found with the entered email address
      return array('status' => 'error', 'message' => 'Incorrect email or password');
    }
  }



  // LOGOUT
  function logout() {
     /
    session_start();
    global $conn; 

    
    $email = $_SESSION['email'];

    // Set Online to 0
    $sql = "UPDATE userdata SET online=0 WHERE email='$email'";
    mysqli_query($conn, $sql);

    
    session_destroy();


    return array('status' => 'success'); 
}




// FETCH PLAYER DATA
function fetchPlayerData() {

  session_start();
  global $conn; 
  
  // Check if the user is logged in
  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    return array('status' => 'error', 'message' => 'Not logged in');          //"Not logged in" Bug still existing (!)
  }
  
  // Get the email of the logged-in user
  $email = $_SESSION['email'];
  
  // Get player data from player with matching playerid (= email of userdata)
  $sql = "SELECT points, coins, level, exp FROM playerdata WHERE playerid='$email'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $points = $row['points'];
    $coins = $row['coins'];
    $level = $row['level'];
    $exp = $row['exp'];
    return array('status' => 'success', 'points' => $points, 'coins' => $coins, 'level' => $level, 'exp' => $exp);
  } else {
    // No player data was found for the user with the matching PLAYERID
    return array('status' => 'error', 'message' => 'Error fetching player data');
  }
}

  
  

// REGISTRATION
function register($email, $password, $username) {

    global $conn;
  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
    // UserData
    $sql = "INSERT INTO userdata (email, password, username) VALUES ('$email', '$hashed_password', '$username')";
    if (mysqli_query($conn, $sql)) {
      // UserData success
  
      // PlayerData
      $sql = "INSERT INTO playerdata (playerid, points, coins, level, exp) VALUES ('$email', 0, 0, 0, 0)";
      if (mysqli_query($conn, $sql)) {
        // PlayerData added
        return array('status' => 'success');
      } else {
        // Error while inserting into the table (playerdata)
        return array('status' => 'error', 'message' => 'Error adding player data');
      }
    } else {
      // Error while inserting into the table (userdata)
      return array('status' => 'error', 'message' => 'Error registering user');
    }
  }
  



// REQUESTS
if (isset($_POST['request'])) {
    if ($_POST['request'] == 'login') {
      
      $response = login($_POST['email'], $_POST['password']);
    } elseif ($_POST['request'] == 'logout') {
      
      $response = logout();
    } elseif ($_POST['request'] == 'register') {
      
      $response = register($_POST['email'], $_POST['password'], $_POST['other_user_info']);
    } elseif ($_POST['request'] == 'fetchPlayerData') {
      n
      $response = fetchPlayerData($_POST['email']);
    } else {
      
      $response = array('status' => 'error', 'message' => 'Invalid request');
    }
  } else {
    
    $response = array('status' => 'error', 'message' => 'No request was made');
  }
  
  t
  echo json_encode($response);