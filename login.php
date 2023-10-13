<?php
$showalert=false;
$login=false;
if ($_SERVER['REQUEST_METHOD']== "POST") 
{
include 'partial/_dbconnect.php';
$username=$_POST['uname'];
$pass=$_POST['pass'];
  // $sql="SELECT * FROM `user29` WHERE `username` ='$username' AND  `password` ='$pass'";
  $sql="SELECT * FROM `user29` WHERE `username` ='$username'";
  $result=mysqli_query($conn,$sql); 
  $num=mysqli_num_rows($result);
  if ($num==1) 
  {
    while ($row=mysqli_fetch_assoc($result)) 
    {
    if(password_verify($pass,$row['password'])) //
    {
    $login=true;
    session_start();
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;
    header("location:welcome.php");
    }
    else
{
  $showalert=true;
}
  }
}
else
{
  $showalert=true;
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MBD Groups</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'partial/_nav.php';
    ?>
    <?php
    if ($login) 
    {
      echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><b>SUCCESS!</b></strong> You are loggedin.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showalert)
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><b>ERROR!</b></strong> Invalid ceredential.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
?>
    <h1 class="text-center">Login To Join MBD Groups</h1>
    <div class="container">
    <form action="/plog/login.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="username" class="form-control" id="username" name="uname" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <div class="col-auto">
    <label for="password" class="col-form-label">Password</label>
  </div>
  <div class="col-auto">
    <input type="password" id="password" name="pass" class="form-control" aria-describedby="passwordHelpInline">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
  </div>
</div>
  <button type="submit" class="btn btn-primary">login</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>