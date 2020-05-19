 <?php include ("includes/header.php");?>
 <!-- ============================================================== -->
 <!-- Page Content -->
 <!-- ============================================================== -->
 
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-primary m-b-10"  data-target="#add_update_Modal" id="add_customer_Modal">
  <i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add Customer
</button>

<!-- Add Modal -->
<div class="modal fade" id="add_update_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</button></h5>
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
        <div class="form-group">
          <label id="phone_start" class="text-danger mb-1"></label>
          <label class="control-label mb-1">Phone</label>
          <input  name="phone" type="number" class="form-control" id="set_phone">
        </div>
        <div class="form-group">
          <label id="address_start" class="text-danger mb-1"></label>
          <label class="control-label mb-1">Address</label>
          <input  name="address" type="text" class="form-control" id="set_address">
        </div>
        <div class="form-group has-success">
          <h4 class="text-danger" id="error"></h4>
        </div>
      </form>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     <button type="submit " class="btn btn-primary"  id="add_customer_btn">Save</button>
     <button type="submit " class="btn btn-primary"  id="update_customer_btn">Update</button>
   </div>
 </div>
</div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete_customer_btn">Yes</button>
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
    <h3 class="box-title">Manage customer</h3>
    <div class="table-responsive">
     <table class="table">
      <thead>
       <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody> 
      <?php
      $query = "select * from customer";
      $result= mysqli_query($conn,$query);
      while ($table_customer=mysqli_fetch_assoc($result)) {
        echo "<tr id={$table_customer['id']}>";
        foreach ($table_customer as $key => $value) {
         echo "<td id='$key{$table_customer['id']}'>";
         echo $value;
         echo "</td>";
       }
       echo "<th><a href='#' name='edit' class='btn btn-primary text-white edit_btn' data-id='{$table_customer['id']}' class='btn btn-danger text-white delete' data-target='#add_update_Modal'>Edite</a></th>";
       echo "<th><a href='#' data-id='{$table_customer['id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</a></th>";
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
    // event whene click Add customer button to show add modal
    $("#add_customer_Modal").click(function() {
      $("#update_customer_btn").hide();
      $("#add_update_Modal").modal('show');
      $("input").val("");
      $(".text-danger").html("");
      $(".modal-title").html("Add Customer");
      $("#add_customer_btn").show();
    });
    // event whene click save in add customer modal 
    $("#add_customer_btn").click(function() {
      $.ajax({
       type: "POST",
       url: "includes/add.php?table_name=customer",
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
            if($("#set_phone").val()==""){
              $("#phone_start").html("*");
            }
            if($("#set_address").val()==""){
              $("#address_start").html("*");
            }
          }
          else{
            location.reload();
          }
        }
      });     
    });

   var row_id=0; //to save tr id
   // event whene click delete customer button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });

     // event whene click yes button in delete customer modal
     $("#delete_customer_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=customer & row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   // event whene click edit customer button to update add modal
   $(".edit_btn").click(function() {
    row_id=$(this).attr('data-id');
    $("#add_customer_btn").hide();
    $("#update_customer_btn").show();
    $("#set_name").val($("#customer_name"+row_id).html());
    $("#set_email").val($("#email"+row_id).html());
    $("#set_password").val($("#password"+row_id).html());
    $("#set_phone").val($("#phone"+row_id).html());
    $("#set_address").val($("#address"+row_id).html());
    $(".modal-title").html("Update Customer");
    $(".text-danger").html("");
    $("#add_update_Modal").modal('show');
  });
   // event whene click update button in update customer modal 
   $("#update_customer_btn").click(function() {
    $.ajax({
     type: "POST",
     url: "includes/edit.php?table_name=customer&row_id="+row_id,
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
              if($("#set_phone").val()==""){
                $("#phone_start").html("*");
              }
              if($("#set_address").val()==""){
                $("#address_start").html("*");
              }
            }
            else{
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
          url: "../ajax/check_email.php?email="+email+"&table_name=customer",
          success: function(returnData){
            id=returnData; 
            if (id!=0) {
              $("#error_email").html("This email already exists");
              $("#add_customer_btn").attr("disabled", true);
              $("#update_customer_btn").attr("disabled", true);
            }
            else{
              $("#error_email").html("");
              $("#add_customer_btn").attr("disabled", false);
              $("#update_customer_btn").attr("disabled", false);
            }
          }
        });
      });
    });

  </script>