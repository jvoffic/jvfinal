<?php

// Mainīgie Global Scope

$user = $password = "";
$success = "";
$regUser = "";
$regPassword = "";
$user = $_POST['regUser'] ?? "";
$password = $_POST['regPassword'] ?? "";
$alreadyRegistered = "";

// Logic

if(isset($_POST['submit'])){
  require_once 'db.php';
  
  $duplicate = "SELECT * FROM users WHERE username='$user'";
  $result = $conn->query($duplicate);
  if ($result->num_rows > 0) {
    $alreadyRegistered = '
    <div class="alert alert-danger" role="alert">
      User already registered !!
    </div>';
      header('refresh:1,index.php');
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$hash')";

    if($conn->query($sql) === TRUE) {
      $success = '
        <div class="alert alert-success" role="alert">
          Lietotājs veiksmīgi reģistrēts!
        </div>
      ';

        header('refresh: 2; login.php');
    } else {
      echo "Error" . $sql . $conn->error;
   }
}
}

?>
<!-- HTML PART -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="wrapper">
        <h1>Register</h1>
        <?php echo $alreadyRegistered ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="regUser">
    <div id="emailHelp" class="form-text">We'll never share your data with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="regPassword">
  </div>
  <button type="submit" class="btn btn-primary " name="submit">Register</button>
  <a href="./login.php" class="btn btn-primary " style="margin-left: 20px">Login</a>
    </form>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>