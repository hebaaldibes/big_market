<?php 
ob_start();
include_once ("includes/header.php");
include("../functions/function.php");?>
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<?php
$id=$_SESSION['admin_id'];
if (isset($_POST['update'])) {
  if($_POST['name']!="" && $_POST['email']!="" && $_POST['password']!=""){   
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query= "update admin set admin_name='$name',
    email='$email',
    password='$password'
    where id=$id";
}
mysqli_query($conn,$query);
}
   $image=upload_image("../plugins/images/users/admin/");
    if($image!=""){
     $query_img= "update admin set image ='$image'
      where id=$id";
      mysqli_query($conn,$query_img);
      header("location:profile.php");
     }
?>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
            <div class="user-bg">
             <img width="100%" alt="user" src="../plugins/images/users/admin/<?php echo $adminSet['image'];?>">
           
                <div class="overlay-box">
                    <div class="user-content">
                         <form method="post" enctype="multipart/form-data" id="img_change_form">
                <input type="file" id="imgupload" style="display: none" name="image">
                        <img src="../plugins/images/users/admin/<?php echo $adminSet['image'];?>"
                            class="thumb-lg img-circle" alt="img" id='OpenImgUpload'>
                             <input type="submit" name="submit_img" id="img_submit" hidden>
                            </form>
                            <h4 class="text-white"><?php echo $adminSet['admin_name'];?></h4>
                            <h5 class="text-white"><?php echo $adminSet['email'];?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material" method="post">
                    <div class="form-group">
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" value="<?php echo $adminSet['admin_name'];?>" name="name"
                            class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" value="<?php echo $adminSet['email'];?>"
                                class="form-control form-control-line" name="email"
                                id="set_email"> 
                                <p id="error_email" class="text-danger"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" placeholder="<?php echo $adminSet['password'];?>" value="<?php echo $adminSet['password'];?>" class="form-control form-control-line" name="password">
                            </div>
                        </div>                         
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" id="update_admin_btn" class="btn btn-success" name="update">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?php include_once 'includes/footer.php';?>
        <!-- java script code -->
        <script type="text/javascript">
        $(document).ready(function() {
           // check email if is exist in database
           $('#set_email').change(function() {
            var id;
            var email=$('#set_email').val();
            $.ajax({
              type: 'GET',
              url: "../includes/check_email.php?email="+email+"&table_name=admin",
              success: function(returnData){
                id=returnData; 
                if (id!=0) {
                  $("#error_email").html("This email already exists");
                  $("#update_admin_btn").attr("disabled", true);
              }
              else{
                  $("#error_email").html("");
                  $("#update_admin_btn").attr("disabled", false);
              }
          }
      });
        });
           $('#OpenImgUpload').click(function(){
            $('#imgupload').trigger('click'); 
});
          $('#imgupload').change(function () {
            $('#img_change_form').trigger('submit');
           });
       });
   </script>
