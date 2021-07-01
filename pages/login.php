<?php
session_start();
// Mainīgie

$user = $_POST['logUser'] ?? "";
$password = $_POST['logPassword'] ?? "";
$loginsucc = "";

// Logic
$sql = "SELECT id, username, password FROM users WHERE username='$user'";

// Login
if(isset($_POST['submit'])) {
  require_once 'db.php';

  $result = $conn->query($sql);

  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if(password_verify($password, $row['password'])) {
      $_SESSION['id'] = $row['id'] ;
      $_SESSION['username'] = $row['username'];
      header('refresh: 1; profile.php');
      $loginsucc = '
      <div class="alert alert-success" role="alert">
      Login Succesful !!
      </div>';
    } else {
      // Wrong Password
      echo '<p style=color:white;>Parole nav pareiza!</p>';
    }
  } else {
    // Wrong Username
    echo 'Nepareizs Lietotājvārds!';
  }
}


?>
<!-- HTML Part -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="wrapper">
        <h1>Login</h1>
        <?php echo $loginsucc ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="logUser">
    <div id="emailHelp" class="form-text">We'll never share your data with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="logPassword">
  </div>
  <button type="submit" class="btn btn-primary " name="submit">Login</button>
  <a href="./index.php" class="btn btn-primary " style="margin-left: 20px">Register</a>
    </form>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>