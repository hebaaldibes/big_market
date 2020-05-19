 <?php 
 include ("includes/header.php");
 include("../functions/function.php");
 ?>
 <?php
//make code run when user click on save button
 if(isset($_POST['save'])){
  if($_POST['market_name']!=""){
    $market_name=$_POST['market_name']; 
    $image=upload_image("../plugins/images/market/");
    if($image!="") {
     $query= "insert into market(market_name,market_logo)
     VALUES ('$market_name','$image')";
     $result = mysqli_query($conn,$query);
   }
   else{
    $query= "insert into market(market_name)
    VALUES ('$market_name')";
    $result = mysqli_query($conn,$query);
  }
}
}
?>
<?php
if (isset($_POST['update'])) {
  if($_POST['market_name']!=""){
    $id=$_POST['row_id'];
    $name=$_POST['market_name'];
    $query= "update market set market_name='$name'
    where id=$id";
    $image=upload_image("../plugins/images/market/");
    if($image!="")  {
      $query= "update market set market_name='$name',
      market_logo='$image'
      where id=$id";
    }
    mysqli_query($conn,$query);
  }
}
?>
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-b-10"  data-target="#add_update_Modal" id="add_market_Modal">
  <i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add market
</button>

<!-- Add Modal -->
<div class="modal fade" id="add_update_Modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add market</button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="post" id="add_update_form" enctype="multipart/form-data">
        <div class="modal-body">
         <div class="form-group">
           <input type="hidden" id="row_Id" name="row_id">

           <label id="name_star" class="text-danger mb-1"></label>

           <label class="control-label mb-1">market name</label>
           <input  name="market_name" type="text" class="form-control" value="" id="set_name" required=" ">
         </div>
         <div class="form-group">
          <label class="control-label mb-1">Market Logo</label>
          <input  name="image" type="file" class="form-control" id="market_img">
          <p id="img_error" class="text-danger mb-1"></p>  
          <p><img src="" alt="Market Logo" id="img_upload" width="100px"></p>     
        </div>
        <div class="form-group has-success">
          <h4 class="text-danger" id="error"></h4>
        </div>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <button type="submit" class="btn btn-primary"  id="add_market_btn" name="save">Save</button>
       <button type="submit" class="btn btn-primary"  id="update_market_btn" name="update">Update</button>
     </div>
   </form>
 </div>
</div>
</div>
<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete market</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete_market_btn">Yes</button>
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
    <h3 class="box-title">Manage market</h3>
    <div class="table-responsive">
     <table class="table">
      <thead>
       <tr>
        <th>#</th>
        <th>Market name</th>
        <th>Market logo</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody> 
      <?php
      $query = "select * from market";
      $result= mysqli_query($conn,$query);
      while ($table_market=mysqli_fetch_assoc($result)) {
        echo "<tr id={$table_market['id']}>";
        foreach ($table_market as $key => $value) {
          if ($key=='market_logo') {
           echo "<td id='$key{$table_market['id']}' scope='row' data-name='$value'>";
           echo "<img src='../plugins/images/market/".$value."'alt='Market Logo' width='100px'>";
           echo "</td>";
           continue;
         }
         echo "<td id='$key{$table_market['id']}' class='m-l-5'>";
         echo $value;
         echo "</td>";
       }
       echo "<th><button name='edit' class='btn btn-primary text-white edit_btn' data-id='{$table_market['id']}' class='btn btn-danger text-white delete' data-target='#add_update_Modal'>Edite</button></th>";
       echo "<th><button data-id='{$table_market['id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</button></th>";
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
    // event whene click Add market button to show add modal
    $("#add_market_Modal").click(function() {
      $("#update_market_btn").hide();
      $("#add_update_Modal").modal('show');
      $("#error").html("");
      $("input").val("");
      $(".text-danger").html("");
      $(".modal-title").html("Add Market");
      $("#img_upload").hide();

      $("#add_market_btn").show();
    });
    $("#add_market_btn").click(function() { 
      var name =$("#set_name").val();
      if(name==""){
        $("#name_star").html("*");
        $("#error").html("This fields is required.");
        return false;
      } 
      else{
        $("#name_star").html("");
        $("#error").html("");
      }
      var extension = $('#market_img').val().split('.').pop().toLowerCase();
      if(extension != '')
      {
       if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
       {
        $("#img_error").html("Invalid Image File");
        $('#market_img').val('');
        return false;
      }
      else{
        $("#img_error").html("");
      }
    } 
  });

   var row_id=0; //to save tr id
   // event whene click delete market button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });
     // event whene click yes button in delete market modal
     $("#delete_market_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=market & row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   // event whene click edit market button to update add modal
   $(".edit_btn").click(function() {
    row_id=$(this).attr('data-id');
    $("#add_market_btn").hide();
    $("#update_market_btn").show();
    $("#row_Id").val(row_id);
    $("#set_name").val($("#market_name"+row_id).html());
    $(".text-danger").html("");
    $("#img_upload").show();
  $("#img_upload").attr("src","../plugins/images/market/"+$("#market_logo"+row_id).attr("data-name"));
    $(".modal-title").html("Update Market");
    $("#add_update_Modal").modal('show');
  });
   // event whene click update button in update market modal 
   $("#update_market_btn").click(function() {
    var img_error =$("#img_error").html();
    var text_error= $("#error").html();
    var star=$("#name_star").html();
    var name =$("#set_name").val();
    if(name==""){
      $("#name_star").html("*");
      $("#error").html("This fields is required.");
      return false;
    } 
    else{
      $("#name_star").html("");
      $("#error").html("");
    }
    var extension = $('#market_img').val().split('.').pop().toLowerCase();
    if(extension != '')
    {
     if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
     {
      $("#img_error").html("Invalid Image File");
      $('#market_img').val('');
      return false;
    }
    else{
      $("#img_error").html("");
    }
  } 
});
 });

</script>