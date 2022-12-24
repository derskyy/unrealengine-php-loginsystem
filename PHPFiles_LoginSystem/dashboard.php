<?php
session_start();

include 'config.php';


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = $_SESSION['email'];

$sql = "SELECT * FROM userdata WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    $playerid = $row['email'];


    $sql = "SELECT * FROM playerdata WHERE playerid='$playerid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $level = $row['level'];
        $points = $row['points'];
        $coins = $row['coins'];
        $playerid = $row['playerid'];
        $exp = $row['exp'];
    } else {
        // Placeholder - Error Debug msg
    }
} else {
    // Placeholder - Error Debug msg
}

$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <!--  CSS and JS for Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <!-- custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Dashboard
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
       <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Button 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Button 2</a>
       </li>
        <li class="nav-item">
        <form action="logout.php" method="post">
          <button type="submit" class="btn btn-link">Logout</button>
        </form>
       </li>
      </ul>
    </div>
  </nav>

<!-- Content -->
<div class="container mt-5">
  <div class="row">
    <!-- Sidebar -->
      <div class="col-3 p-5" style="background-color: #f5f5f5;">
        <h3>Informations</h3>
        <p>Here you can find your player information such as coins and your level.</p>
        <table>
          <tr>
            <td>Rank:</td>
            <td><?php echo $level; ?></td>
          </tr>
          <tr>
            <td>EXP:</td>
            <td><?php echo $exp; ?></td>
          </tr>
          <tr>
            <td>Points:</td>
            <td><?php echo $points; ?></td>
          </tr>
          <tr>
            <td>Coins:</td>
            <td><?php echo $coins; ?></td>
          </tr>
          <tr>
            <td><br>Player:</td>
          </tr>
          <tr>
            <td><?php echo $playerid; ?></td>
          </tr>
        </table>
      </div>
    <!-- Main content -->
    <div class="col-9 p-5" style="background-color: #f5f5f5;">
      <h1>Welcome <?php echo $playerusername; ?> !</h1>
      <p>Here you can add your own custom content. This area is the main area. Above this message I added the Username to personalize the page.</p>
      <!-- Graph -->
      <div class="my-5">
        <canvas id="myChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!--  Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<!-- Graph -->
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',

    // data for the dataset
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'Player Information',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45]
      }]
    },

    // OPtions
    options: {}
  });
</script>


  <!-- Footer -->
  <footer class="bg-light py-3 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <p>&copy; Your Copyright notice</p>
        </div>
        <div class="col-6 text-right">
          <a href="#">Imprint</a> | <a href="#">Privacy Policy</a>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
         