<?php
session_start();
require ("../includes/connection.php");
if (isset($_POST['submit'])) {
 $email =$_POST['email'];
 $password=$_POST['password'];

 $query ="SELECT * FROM admin where email='$email' AND password ='$password'";
 $result= mysqli_query($conn,$query);
 $adminSet= mysqli_fetch_assoc($result);
 if (isset($adminSet['id'])) {
  $_SESSION['admin_id']=$adminSet['id'];
  header("location:index.php");
}
else{
  $error= "Not find user";
}
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>

  <link rel="stylesheet" href="../css/login_style.css">

  
</head>

<body>
  <div class="signupSection">
    <div class="info">
      <h2>Big Market Dasborad</h2>
      <i class="icon" aria-hidden="true">
        <img src="../plugins/images/admin-logo-dark.png" alt="home"
        class="dark-logo" width="100px" />
      </i>
    </div>
    <form action="#" method="POST" class="signupForm" name="signupform">
      <h2>Login</h2>
      <ul class="noBullet">
       <li>
        <label for="email"></label>
        <input type="email" class="inputFields" id="email" name="email" placeholder="Email" value="" required/>
      </li>
      <li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password" name="password" placeholder="Password" value=""  required/>
      </li>
      <li>
        <?php if (isset($error)) {
          echo "<div class='sufee-alert alert with-close alert-danger alert-dismissible fade show'>
          $error
          </div>";
        }?>
      </li>
      <li id="center-btn">
        <input type="submit" id="join-btn" name="submit" alt="Join" value="Login">
      </li>
    </ul>
  </form>
</div>
</body>
</html>
