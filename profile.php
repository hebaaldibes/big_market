<?php include ("includes/header.php");?>
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<?php
$id=$_SESSION['login_user']["cast_id"];
if (isset($_POST['update'])) {  
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone=$_POST['phone'];
    $addess=$_POST['address'];

    $query= "update customer set customer_name='$name',
    email='$email',
    password='$password',
    phone=$phone,
    address='$addess'
    where id=$id";
    mysqli_query($conn,$query);
}


    $queryread ="SELECT * FROM customer WHERE id=$id";
 $r= mysqli_query($conn,$queryread);
 $customerSet= mysqli_fetch_assoc($r);

?>
<div class="register">
  <div class="container">
    <h2>Register Here</h2>
    <div class="login-form-grids">
      <h5>profile information</h5>
      <form action="#" method="post">
      <input type="text" placeholder="Full Name..." required=" " name="name" value="<?php echo $customerSet['customer_name']?>">
      <input type="email" placeholder="Email Address" required=" " name="email" id="cast_email" value="<?php echo $customerSet['email']?>">
      <p id="error_email" class="text-danger" style="color: #FF0000FF;"></p>
      <input type="password" placeholder="Password" required=" " name="password" id="pass" value="<?php echo $customerSet['password']?>">
      <input type="number" placeholder="Phone number" required=" " class="number_input" name="phone" value="<?php echo $customerSet['phone']?>">
      <textarea placeholder="Address" required=" " name="address" value="<?php echo $customerSet['address']?>"><?php echo $customerSet['address']?></textarea>
      

      <input type="submit" value="Update" name="update" id="update">
      </form>
    </div>
    <div class="register-home">
      <a href="index.php">Home</a>
    </div>
  </div>
</div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?php include 'includes/footer.php';?>
    <script type="text/javascript">
        $(document).ready(function() {
           // check email if is exist in database
           $('#set_email').change(function() {
            var id;
            var email=$('#set_email').val();
            $.ajax({
              type: 'GET',
              url: "p/includes/check_email.php?email="+email+"&table_name=customer",
              success: function(returnData){
                id=returnData; 
                if (id!=0) {
                  $("#error_email").html("This email already exists");
                  $("#update_customer_btn").attr("disabled", true);
              }
              else{
                  $("#error_email").html("");
                  $("#update_customer_btn").attr("disabled", false);
              }
          }
      });
        });
       });
   </script>