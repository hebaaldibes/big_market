 <?php include ("includes/header.php");?>
 <!-- ============================================================== -->
 <!-- Page Content -->
 <!-- ============================================================== -->
 
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-primary m-b-10"  data-target="#add_update_Modal" id="add_category_Modal">
 	<i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add Category
 </button>

 <!-- Add Modal -->
 <div class="modal fade" id="add_update_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Add Category</button></h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
         <form action="" method="post" id="add_update_form">
           <div class="form-group">
            <label id="name_start" class="text-danger mb-1"></label>
            <label class="control-label mb-1">Category name</label>
            <input  name="category_name" type="text" class="form-control" value="" id="set_name">
          </div>
          <div class="form-group has-success">
            <h4 class="text-danger" id="error"></h4>
          </div>
        </form>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <button type="submit " class="btn btn-primary"  id="add_category_btn">Save</button>
       <button type="submit " class="btn btn-primary"  id="update_category_btn">Update</button>
     </div>
   </div>
 </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete_category_btn">Yes</button>
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
    <h3 class="box-title">Manage category</h3>
    <div class="table-responsive">
     <table class="table">
      <thead>
       <tr>
        <th>#</th>
        <th>Category name</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody> 
      <?php
      $query = "select * from category";
      $result= mysqli_query($conn,$query);
      while ($table_category=mysqli_fetch_assoc($result)) {
        echo "<tr id={$table_category['id']}>";
        foreach ($table_category as $key => $value) {
         echo "<td id='$key{$table_category['id']}'>";
         echo $value;
         echo "</td>";
       }
       echo "<th><button name='edit' class='btn btn-primary text-white edit_btn' data-id='{$table_category['id']}' class='btn btn-danger text-white delete' data-target='#add_update_Modal'>Edite</button></th>";
       echo "<th><button data-id='{$table_category['id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</button></th>";
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
    // event whene click Add category button to show add modal
    $("#add_category_Modal").click(function() {
      $("#update_category_btn").hide();
      $("#add_update_Modal").modal('show');
      $("#error").html("");
      $("input").val("");
      $(".text-danger").html("");
      $(".modal-title").html("Add Category");
      $("#add_category_btn").show();
    });
    // event whene click save in add category modal 
    $("#add_category_btn").click(function() {
      $.ajax({
       type: "POST",
       url: "includes/add.php?table_name=category",
           data: $("#add_update_form").serialize(), // serializes the form's elements.
           success: function(data)
           { 
           	if (data=="false") {
               $("#error").html("This field is required.");
               $("#name_start").html("*");
             }else{
               location.reload();

             }
           }
         });			
    });
   var row_id=0; //to save tr id
   // event whene click delete category button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });

     // event whene click yes button in delete category modal
     $("#delete_category_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=category & row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   // event whene click edit category button to update add modal
   $(".edit_btn").click(function() {
    row_id=$(this).attr('data-id');
    $("#add_category_btn").hide();
    $("#update_category_btn").show();
    $("#set_name").val($("#cat_name"+row_id).html());
    $(".text-danger").html("");
    $(".modal-title").html("Update Category");
    $("#add_update_Modal").modal('show');
  });
   // event whene click update button in update category modal 
   $("#update_category_btn").click(function() {
    $.ajax({
     type: "POST",
     url: "includes/edit.php?table_name=category&row_id="+row_id,
           data: $("#add_update_form").serialize(), // serializes the form's elements.
           success: function(data)
           {
           	if (data=="false") {
              $("#error").html("This field is required.");
              if($("#set_name").html()==""){
                $("#name_start").html("*");
              }
            }
            else{
              location.reload();
            }
          }
        });			
  });
 });

</script>