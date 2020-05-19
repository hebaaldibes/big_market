 <?php include ("includes/header.php");?>
 <!-- ============================================================== -->
 <!-- Page Content -->
 <!-- ============================================================== -->
 
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-primary m-b-10"  data-target="#add_update_Modal" id="add_subcategory_Modal">
  <i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add SubCategory
</button>

<!-- Add Modal -->
<div class="modal fade" id="add_update_Modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add SubCategory</button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="" method="post" id="add_update_form">
         <div class="form-group">
          <label id="name_star" class="text-danger mb-1"></label>
          <label class="control-label mb-1">SubCategory Name</label>
          <input  name="sub_cat_name" type="text" class="form-control" value="" id="sub_cat_name" >
        </div>
        <div class="form-group">
          <label id="category_star" class="text-danger mb-1"></label>
          <label class="control-label mb-1">Main category Name</label>
          <select id="category_select" class="form-control" name="category_name">
            <option value="" disabled selected hidden>Please Choose Category</option>
            <?php
            $query = "select * from category ORDER BY
            cat_name";
            $result= mysqli_query($conn,$query);
            while ($categoryName=mysqli_fetch_assoc($result)) {
             echo "<option value='{$categoryName['id']}' data-id='{$categoryName['id']}'>{$categoryName['cat_name']}</option>";
           }
           ?>  
         </select>
       </div>
       <div class="form-group has-success">
        <h4 class="text-danger" id="error"></h4>
      </div>
    </form>
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   <button type="submit " class="btn btn-primary"  id="add_subcategory_btn">Save</button>
   <button type="submit " class="btn btn-primary"  id="update_subcategory_btn">Update</button>
 </div>
</div>
</div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deletesubcategory_btn">Yes</button>
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
    <h3 class="box-title">Manage subcategory</h3>
    <div class="table-responsive">
     <table class="table">
      <thead>
       <tr>
        <th>#</th>
        <th>SubCategory name</th>
        <th>Main category name</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody> 
      <?php
      $query = "select subcategory.id,subCatName,category.cat_name,cat_id
      from subcategory INNER JOIN category
      on subcategory.cat_id = category.id";

      $result= mysqli_query($conn,$query);
      while ($table_subcategory=mysqli_fetch_assoc($result)) {
        echo "<tr id={$table_subcategory['id']}>";
        foreach ($table_subcategory as $key => $value) {
         if ($key=='cat_id') {
           continue;
         }
         echo "<td id='$key{$table_subcategory['id']}' data-id='{$table_subcategory['cat_id']}'>";
         echo $value;
         echo "</td>";
       }
       echo "<th><button name='edit' class='btn btn-primary text-white edit_btn' data-id='{$table_subcategory['id']}' class='btn btn-danger text-white delete' data-target='#add_update_Modal'>Edite</button></th>";
       echo "<th><button data-id='{$table_subcategory['id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</button></th>";
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
    // event whene click Add subcategory button to show add modal
    $("#add_subcategory_Modal").click(function() {
      $("#update_subcategory_btn").hide();
      $("#add_update_Modal").modal('show');
      $("input").val("");
      $(".text-danger").html("");
      $(".modal-title").html("Add SubCategory");
      $("#add_subcategory_btn").show();
    });
    // event whene click save in add subcategory modal 
    $("#add_subcategory_btn").click(function() {
      $.ajax({
       type: "POST",
       url: "includes/add.php?table_name=subcategory",
           data: $("#add_update_form").serialize(), // serializes the form's elements.
           success: function(data)
           { 
            if (data=="false") {
             $("#error").html("This fields is required.");
             if($("#sub_cat_name").val()==""){
              $("#name_star").html("*");
            }
            if($("#category_select option:selected").val()==""){
              $("#category_star").html("*");
            }
          }else{
            location.reload();

          }
        }
      });     
    });

   var row_id=0; //to save tr id
   // event whene click delete subcategory button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });

     // event whene click yes button in delete subcategory modal
     $("#deletesubcategory_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=subcategory & row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   // event whene click edit subcategory button to update add modal
   $(".edit_btn").click(function() {
    row_id=$(this).attr('data-id');
    $("#add_subcategory_btn").hide();
    $("#update_subcategory_btn").show();
    $("#sub_cat_name").val($("#subCatName"+row_id).html());
    $("#category_select").val($("#cat_name"+row_id).attr('data-id'));
    $(".text-danger").html("");
    $(".modal-title").html("Update SubCategory");
    $("#add_update_Modal").modal('show');
  });
   // event whene click update button in update subcategory modal 
   $("#update_subcategory_btn").click(function() {
    $.ajax({
     type: "POST",
     url: "includes/edit.php?table_name=subcategory&row_id="+row_id,
           data: $("#add_update_form").serialize(), // serializes the form's elements.
           success: function(data)
           {
            if (data=="false") {
              $("#error").html("This fields is required.");
              if($("#sub_cat_name").val()==""){
                $("#name_star").html("*");
              }
              if($("#category_select option:selected").val()==""){
                $("#category_star").html("*");
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