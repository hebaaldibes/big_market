<?php 
require ("includes/connection.php");
session_start();
$ok=1;
if(isset($_POST['login'])) {
      // email and password sent from form 
   if(isset($_POST['email'])||isset($_POST['password'])){
      $email = $_POST['email'];
      $password = $_POST['password']; 

      $query = "SELECT * FROM customer WHERE email='$email' && password='$password'";
      $result= mysqli_query($conn,$query);
      while ($row = mysqli_fetch_assoc($result)){

         $cast_id = $row['id'];
          $username =$row['customer_name'];
      // If result matched $email and $password, table row must be > 0 row
         if($cast_id > 0) {
         //session_register("myusername");
         	$_SESSION['login_user']["username"] = $username;
            $_SESSION['login_user']["cast_id"] = $cast_id;

            header("location:index.php");
         }
         else {
            $ok=0;
            $error = "Your Login Name or Password is invalid";
         }
      }
   }
}

?>
<?php include ("includes/header.php");?>
<!-- //navigation -->
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Login Page</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
	<div class="login">
		<div class="container">
			<h2>Login Form</h2>
		
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="post">
					<input type="email" placeholder="Email Address" required=" " name="email">
					<input type="password" placeholder="Password" required=" " name="password" >
					<div class="error">
						<?php if ($ok ==0){
							echo "string";
						} {
							# code...
						}?>
					</div>
					<input type="submit" name="login" value="Login" id="login_btn">
				</form>
			</div>
			<h4>For New People</h4>
			<p><a href="registered.html">Register Here</a> (Or) go back to <a href="index.html">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
		</div>
	</div>
<!-- //login -->
<?php include ("includes/footer.php");?>