<?php
$showalert=false;
$pa=false;
if ($_SERVER['REQUEST_METHOD']== "POST") 
{
include 'partial/_dbconnect.php';
$username=$_POST['uname'];
$pass=$_POST['pass'];
$cpass=$_POST['cpass'];
$exists=false;
//check whether the username is exist:
$existsql="SELECT * FROM `user29` WHERE `username`='$username'";
$result=mysqli_query($conn,$existsql);
$numExistsRows=mysqli_num_rows($result);
if ($numExistsRows>0) 
{
$pa="Username Already Exists";
}
else {
if (($pass==$cpass)) 
{
  $hash=password_hash($pass,PASSWORD_DEFAULT);//
  $sql="INSERT INTO `user29` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
  $result=mysqli_query($conn,$sql);
  if ($result) 
  {
    $showalert="Your account is created";
  }
}
else
{
  $pa="Password do not match"; 
}
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
    if ($showalert) 
    {
      echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><b>SUCCESS!</b></strong> '.$showalert.'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($pa)
    {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><b>ERROR!</b></strong>'.$pa.'.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
?>
    <h1 class="text-center">Create a account to Join MBD Groups</h1>
    <div class="container">
    <form action="/plog/signup.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="username" maxlength="11" class="form-control" id="username" name="uname" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <div class="col-auto">
    <label for="password" class="col-form-label">Password</label>
  </div>
  <div class="col-auto">
    <input type="password" maxlenght="20" id="password" name="pass" class="form-control" aria-describedby="passwordHelpInline">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
  </div>
</div>
<div class="mb-3">
  <div class="col-auto">
    <label for="password" class="col-form-label">Confirm Password</label>
  </div>
  <div class="col-auto">
    <input type="password" maxlenght="20" id="cpass" name="cpass" class="form-control" aria-describedby="passwordHelpInline">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
  </div>
</div>
  <button type="submit" class="btn btn-primary">signup</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>