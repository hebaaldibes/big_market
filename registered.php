<?php
require ("includes/connection.php");
session_start();
if (isset($_POST['submit'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$phone=$_POST['phone'];
	$addess=$_POST['address'];

	$query= "insert into customer(email,customer_name,password,phone,address)
	VALUES ('$email', '$name', '$pass', '$phone', '$addess')";

	 mysqli_query($conn,$query);


  $query_login= "SELECT * FROM customer WHERE email='$email' && password='$pass'";
      $result= mysqli_query($conn,$query_login);
      while ($row = mysqli_fetch_assoc($result)){

         $cast_id = $row['id'];
         $username =$row['customer_name'];

      // If result matched $email and $password, table row must be > 0 row
         if($cast_id > 0) {
         //session_register("myusername");
            $_SESSION['login_user']["username"] = $username;
            $_SESSION['login_user']["cast_id"] = $cast_id;

            header("location: index.php");
         }
}
}
?>
<?php include ("includes/header.php");?>
<!-- breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Register Page</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- register -->
<div class="register">
	<div class="container">
		<h2>Register Here</h2>
		<div class="login-form-grids">
			<h5>profile information</h5>
			<form action="#" method="post">
		    <input type="text" placeholder="Full Name..." required=" " name="name">
			<input type="email" placeholder="Email Address" required=" " name="email" id="cast_email">
			<p id="error_email" class="text-danger" style="color: #FF0000FF;"></p>
			<input type="password" placeholder="Password" required=" " name="password" id="pass">
			<input type="password" placeholder="Password Confirmation" required=" " id="re_pass" > 
			<p id="error_pass" class="text-danger" style="color: #FF0000FF;"></p>
			<input type="number" placeholder="Phone number" required=" " class="number_input" name="phone">
			<textarea placeholder="Address" required=" " name="address"></textarea>
			

			<input type="submit" value="Register" name="submit" id="signup_btn">
			</form>
		</div>
		<div class="register-home">
			<a href="index.php">Home</a>
		</div>
	</div>
</div>
<!-- //register -->

<script type="text/javascript">
	$(document).ready(function() {
		   // check email if is exist in database
   $('#cast_email').change(function() {
    var id;
    var email=$('#cast_email').val();
    $.ajax({
      type: 'GET',
      url: "p/ajax/check_email.php?email="+email+"&table_name=customer",
      success: function(returnData){
        id=returnData; 
        if (id!=0) {
          $("#error_email").html("This email already exists");
          $("#signup_btn").attr("disabled", true);
        }
        else{
          $("#error_email").html("");
          $("#signup_btn").attr("disabled", false);
        }
      }
    });
  });
		$("#pass").change(function(){
			if($("#re_pass").val()!=""){
				if ($("#pass").val()!==$("#re_pass").val()) {
					$("#error_pass").html("Password and confirm password does not match.");
					$("#signup_btn").attr("disabled", true);
				}
				else{
					$("#error_pass").html("");
					$("#signup_btn").attr("disabled", false);

				}
			}
		});

		$("#re_pass").change(function(){
			if($("#pass").val()!=""){
				if ($("#re_pass").val()!==$("#pass").val()) {
					$("#error_pass").html("Your password and confirmation password do not match.");
					$("#signup_btn").attr("disabled", true);
				}
				else{
					$("#error_pass").html("");
					$("#signup_btn").attr("disabled", false);

				}
			}
		});

	});
</script>
<?php include ("includes/footer.php");?>
