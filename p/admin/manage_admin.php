 <?php include ("includes/header.php");?>
 <!-- ============================================================== -->
 <!-- Page Content -->
 <!-- ============================================================== -->
 
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-primary m-b-10"  data-target="#add_update_Modal" id="add_admin_Modal">
 	<i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add Admin
 </button>

 <!-- Add Modal -->
 <div class="modal fade" id="add_update_Modal" tabindex="-1" role="dialog" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" >Add Admin</button></h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
         <form action="" method="post" id="add_update_form">
           <div class="form-group">
            <label id="name_start" class="text-danger mb-1"></label>
            <label class="control-label mb-1">Full Name</label>
            <input  name="full_name" type="text" class="form-control" value="" id="set_name" >
          </div>
          <div class="form-group">
            <label id="email_start" class="text-danger mb-1"></label>
            <label class="control-label mb-1">Email</label>
            <input name="email" type="text" class="form-control" id="set_email">
            <p id="error_email" class="text-danger"></p>
          </div>
          <div class="form-group has-success">
            <label id="password_start" class="text-danger mb-1"></label>
            <label class="control-label mb-1">Password</label>
            <input  name="password" type="text" class="form-control" id="set_password">
          </div>
          <div class="form-group has-success">
            <h4 class="text-danger" id="error"></h4>
          </div>
        </form>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <button type="submit " class="btn btn-primary"  id="add_admin_btn">Save</button>
       <button type="submit " class="btn btn-primary"  id="update_admin_btn">Update</button>
     </div>
   </div>
 </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleteAdmin_btn">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- ============================================================== -->
<!-- table -->
<!-- ============================================================== -->
<div class="row ">
  <div class="col-md-12 col-lg-12 col-sm-12">
   <div class="white-box">
    <h3 class="box-title">Manage Admin</h3>
    <div class="table-responsive">
     <table class="table">
      <thead>
       <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Admin Image</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody> 
      <?php
      $query = "select * from admin";
      $result= mysqli_query($conn,$query);
      while ($table_admin=mysqli_fetch_assoc($result)) {
                       if($table_admin['id']==$_SESSION['admin_id']){
        continue;
      }
        echo "<tr id={$table_admin['id']}>";
        foreach ($table_admin as $key => $value) {
        if ($key=='image') {
         echo "<td>";
         echo "<img src='../plugins/images/users/admin/$value' alt='Admin Image'>";
         echo "</td>";
         continue;
       }
       echo "<td id='$key{$table_admin['id']}'>";
       echo $value;
       echo "</td>";
     }
     echo "<th><a href='#' name='edit' class='btn btn-primary text-white edit_btn' data-id='{$table_admin['id']}' class='btn btn-danger text-white delete' data-target='#add_update_Modal'>Edite</a></th>";
     echo "<th><a href='#' data-id='{$table_admin['id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</a></th>";
     echo "</tr>";
   }
   ?>
 </tbody>
</table>
</div>
</div>
</div>
</div>

<?php include 'includes/footer.php';?>

<script type="text/javascript">
	$(document).ready(function() {
    // event whene click Add admin button to show add modal
    $("#add_admin_Modal").click(function() {
      $("#update_admin_btn").hide();
      $("#add_update_Modal").modal('show');
      $("input").val("");
      $(".text-danger").html("");
      $(".modal-title").html("Add Admin");
      $("#add_admin_btn").show();
    });
    // event whene click save in add admin modal 
    $("#add_admin_btn").click(function() {
      $.ajax({
       type: "POST",
       url: "includes/add.php?table_name=admin",
           data: $("#add_update_form").serialize(), // serializes the form's elements.
           success: function(data)
           { 
           	if (data=="false") {
               $("#error").html("This fields is required.");
               if($("#set_name").val()==""){
                $("#name_start").html("*");
              }
              if($("#set_email").val()==""){
                $("#email_start").html("*");
              }
              if($("#set_password").val()==""){
                $("#password_start").html("*");
              }
            }else{
/*        $("tbody").append(data); // show response from the php script.
$("#add_update_Modal").modal('hide'); */
location.reload();

}
}
});			
    });

   var row_id=0; //to save tr id
   // event whene click delete admin button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });

     // event whene click yes button in delete admin modal
     $("#deleteAdmin_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=admin & row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   // event whene click edit admin button to update add modal
   $(".edit_btn").click(function() {
    row_id=$(this).attr('data-id');
    $("#add_admin_btn").hide();
    $("#update_admin_btn").show();
    $("#set_name").val($("#admin_name"+row_id).html());
    $("#set_email").val($("#email"+row_id).html());
    $("#set_password").val($("#password"+row_id).html());
    $(".text-danger").html("");
    $(".modal-title").html("Update Admin");
    $("#add_update_Modal").modal('show');
  });
   // event whene click update button in update admin modal 
   $("#update_admin_btn").click(function() {
    $.ajax({
     type: "POST",
     url: "includes/edit.php?table_name=admin&row_id="+row_id,
           data: $("#add_update_form").serialize(), // serializes the form's elements.
           success: function(data)
           {
           	if (data=="false") {
              $("#error").html("This fields is required.");
              if($("#set_name").val()==""){
                $("#name_start").html("*");
              }
              if($("#set_email").val()==""){
                $("#email_start").html("*");
              }
              if($("#set_password").val()==""){
                $("#password_start").html("*");
              }
            }
            else{
/*              $("#"+row_id).html(data); // show response from the php script.
              $("#add_update_Modal").modal('hide'); 
              $("input").val("");*/
              location.reload();
            }
          }
        });			
  });
   // check email if is exist in database
   $('#set_email').change(function() {
    var id;
    var email=$('#set_email').val();
    $.ajax({
      type: 'GET',
      url: "../ajax/check_email.php?email="+email+"&table_name=admin",
      success: function(returnData){
        id=returnData; 
        if (id!=0) {
          $("#error_email").html("This email already exists");
          $("#add_admin_btn").attr("disabled", true);
          $("#update_admin_btn").attr("disabled", true);
        }
        else{
          $("#error_email").html("");
          $("#add_admin_btn").attr("disabled", false);
          $("#update_admin_btn").attr("disabled", false);
        }
      }
    });
  });
 });

</script>