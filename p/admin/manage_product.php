 <?php 
 include ("includes/header.php");
 include("../functions/function.php");
 ?>
 <?php
 // get value from checkbox
 $new_price=0;
//make code run when user click on save button
 if(isset($_POST['save'])){
  if($_POST['product_name']!="" && $_POST['price']!=""&&$_POST['productDesc']!=""&&$_POST['category_name']!=""&&$_POST['subcategory_name']!=""&&$_POST['market_name']!=""){
    $product_name=$_POST['product_name']; 
    $product_price=$_POST['price'];
    $discount=0;
    $description=$_POST['productDesc'];
    $cat_id=$_POST['category_name'];
    $subcat_id=$_POST['subcategory_name'];
    $market_id=$_POST['market_name'];
    $date = date("Y/m/d");
    $date_sale="";
    $featured="False";
    $soon="False";
    $sale="False";
    if(isset($_POST['featured'])){
      $featured=$_POST['featured'];
    }
    if(isset($_POST['soon'])){
      $soon=$_POST['soon'];
    }
    if(isset($_POST['sale'])){
      $sale=$_POST['sale'];
      $discount=$_POST['discount'];
        // check if box_sale checked and $_post['discount'] is set
      if ($_POST['discount']!="" && $sale=="sale") {
        $disc=(int)$_POST['discount'];
        $discount_val=($disc/100)*$product_price;
        $new_price=$product_price-$discount_val;
        $date_sale=$date;
      }
    }


    // check image extention and move location
    $image=upload_image("../plugins/images/product/");
    if($image!="") {
      $query= "insert into product(product_name,product_price,new_price, product_description,product_img,cat_id,sub_cat_id,market_id,date_sale,sale,featured_product,coming_soon)
      VALUES ('$product_name','$product_price','$new_price','$description','$image',$cat_id,$subcat_id,$market_id,'$date_sale','$sale','$featured','$soon')";
      $result = mysqli_query($conn,$query);
    }
  }
}
?>
<?php
if (isset($_POST['update'])) {
  if($_POST['row_id']!=""&&$_POST['product_name']!="" && $_POST['price']!=""&&$_POST['productDesc']!=""&&$_POST['category_name']!=""&&$_POST['subcategory_name']!=""&&$_POST['market_name']!=""){

    $id=$_POST['row_id'];
    $product_name=$_POST['product_name']; 
    $product_price=$_POST['price'];
    $description=$_POST['productDesc'];
    $cat_id=$_POST['category_name'];
    $subcat_id=$_POST['subcategory_name'];
    $market_id=$_POST['market_name'];    
    $query= "update product set product_name='$product_name',
    product_price='$product_price',
    new_price='$new_price',
    product_description='$description',
    cat_id=$cat_id,
    sub_cat_id=$subcat_id,
    market_id=$market_id
    where id=$id";
    mysqli_query($conn,$query);

    if(isset($_POST['featured'])&&$_POST['featured']=='featured'){
      $query= "update product set featured_product='featured'
      where id=$id";
      mysqli_query($conn,$query);
    }
    else{
      $query= "update product set featured_product='False'
      where id=$id";
      mysqli_query($conn,$query);
    }
    if(isset($_POST['soon'])&&$_POST['soon']=='soon'){
      $query= "update product set coming_soon='soon'
      where id=$id";
      mysqli_query($conn,$query);
    }
    else{
      $query= "update product set coming_soon='False'
      where id=$id";
      mysqli_query($conn,$query);
    }
    if(isset($_POST['sale'])&&$_POST['sale']=='sale'){
      $disc=(int)$_POST['discount'];
      $discount=($disc/100)*$product_price;
      $new_price=$product_price-$discount;
      $date_sale= date("Y/m/d");
      $query= "update product set sale='sale',
      date_sale='$date_sale',
      new_price=$new_price
      where id=$id";
      mysqli_query($conn,$query);
    }
    else{
      $query= "update product set sale='False',
      date_sale='0'
      where id=$id";
      mysqli_query($conn,$query);
    }

    $image=upload_image("../plugins/images/product/");
    if($image!="")  {
      $query= $query= "update product set  product_img ='$image'
      where id=$id";
      mysqli_query($conn,$query);
    }
  }
}
?>

<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-b-10"  data-target="#add_update_Modal" id="add_product_Modal">
  <i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Add product
</button>

<!-- Add Modal -->
<!-- Add Modal -->
<div class="modal fade" id="add_update_Modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="post" id="add_update_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
           <input type="hidden" id="row_Id" name="row_id">
           <label id="name_star" class="text-danger mb-1"></label>
           <label class="control-label mb-1">Product Name</label>
           <input  name="product_name" type="text" class="form-control" value="" id="set_name" required="">

         </div>
         <div class="form-group">
          <label id="price_star" class="text-danger mb-1"></label>
          <label class="control-label mb-1">Price</label>
          <input name="price" type="number" class="form-control" id="set_price" required="">
        </div>
        <div class="form-group has-success">
          <label id="image_star" class="text-danger mb-1"></label>
          <label class="control-label mb-1">Image</label>
          <input  name="image" type="file" class="form-control" id="set_image" required="">
          <p id="image_error" class="text-danger mb-1"></p>
          <p><img src="" alt="Product Image" id="img_upload" width="100px"></p>
        </div>
        <div class="form-group">
          <label id="cat_star" class="text-danger mb-1"></label>
          <label class="control-label mb-1">Category</label>
          <select id="category_select" class="form-control" name="category_name" required="">
            <option value="" disabled selected hidden>Please Choose Category</option>
            <?php
            $query = "select * from category ORDER BY cat_name";
            $result= mysqli_query($conn,$query);
            while ($categoryName=mysqli_fetch_assoc($result)) {
             echo "<option value='{$categoryName['id']}' data-id='{$categoryName['id']}'>{$categoryName['cat_name']}</option>";
           }
           ?>  
         </select>
       </div>
       <div class="form-group">
        <label id="subcat_star" class="text-danger mb-1"></label>
        <label class="control-label mb-1">SubCategory</label>
        <select id="subcategory_select" class="form-control" name="subcategory_name" required="">
          <option value="" disabled selected hidden>Please Choose SubCategory</option>
        </select>
      </div>
      <div class="form-group">
        <label id="market_star" class="text-danger mb-1"></label>
        <label class="control-label mb-1">Market</label>
        <select id="market_select" class="form-control" name="market_name" required="">
          <option value="" disabled selected hidden>Please Choose Markert</option>
          <?php
          $query = "select * from market ORDER BY market_name";
          $result= mysqli_query($conn,$query);
          while ($marketName=mysqli_fetch_assoc($result)) {
           echo "<option value='{$marketName['id']}'data-id='{$marketName['id']}'>{$marketName['market_name']}</option>";}
           ?>  
         </select>
       </div>
       <div class="form-group">
        <label id="desc_star" class="text-danger mb-1"></label>
        <label class="control-label mb-1">Description</label>
        <textarea name="productDesc" type="text" class="form-control" id="set_desc"></textarea>
      </div>
      <div class="form-group">
       <label id="discount_star" class="text-danger mb-1"></label>
       <label class="control-label mb-1">Discount Value</label>
       <input name="discount" type="number" class="form-control" id="set_discount">
     </div>
     <div class="form-group">
       <label class="control-label mb-1">Features</label><br>
       <input type="checkbox" id="sale"  value="sale" name="sale">
       <label class="control-label mb-1">Sale</label><br>
       <input type="checkbox" id="featured" value="featured" name="featured">
       <label class="control-label mb-1">Featured Product</label><br>
       <input type="checkbox" id="soon" value="soon" name="soon">
       <label class="control-label mb-1">Coming Soon</label><br>
     </div>
     <div class="form-group has-success">
      <h4 class="text-danger" id="error"></h4>
    </div>
  </div>
  <div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   <button type="submit" class="btn btn-primary"  id="add_product_btn" name="save">Save</button>
   <button type="submit" class="btn btn-primary"  id="update_product_btn" name="update">Update</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="delete_product_btn">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- ============================================================== -->
<!-- table -->
<!-- ============================================================== -->
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
   <div class="white-box">
    <h3 class="box-title">Manage product</h3>
    <div class="table-responsive">
     <table class="table" id="table_product">
      <thead>
       <tr>
        <th scope="col">#</th>
        <th scope="col">Product name</th>
        <th scope="col">product price</th>
        <th scope="col">New price</th>
        <th scope="col">Product image</th>
        <th scope="col">Main category</th>
        <th scope="col">SubCategory</th>
        <th scope="col">Markert name</th>
        <th scope="col">Date set</th>
        <th scope="col">Description</th>
        <th scope="col">Sale</th>
        <th scope="col">Date of sale</th>
        <th scope="col">Featured product</th>
        <th scope="col">Coming soon</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody> 
      <?php
      $query = "select product.id,product_name,product_price,new_price,product_img,product.cat_id,product.sub_cat_id,product.market_id,market.market_name,category.cat_name,subcategory.subCatName,date_set,product_description,sale,date_sale,featured_product,coming_soon from product 
      INNER JOIN category ON category.id = product.cat_id
      INNER JOIN subcategory ON subcategory.id = product.sub_cat_id
      INNER JOIN market ON market.id = product.market_id
      ORDER BY product.id";
      $result= mysqli_query($conn,$query);
      while ($table_product=mysqli_fetch_assoc($result)) {
        echo "<tr id={$table_product['id']}>";
        foreach ($table_product as $key => $value) {
          if ($key=='market_id' ||$key=='sub_cat_id'||$key=='cat_id') {
            continue;
          }

          elseif ($key=='product_img') {
           echo "<td id='$key{$table_product['id']}' data-name='$value'>";
           echo "<image src='../plugins/images/product/".$value."'alt='product Logo' width='100px'>";
           echo "</td>";

         }
         elseif ($key=='cat_name') {
           echo "<td id='$key{$table_product['id']}' data-id='{$table_product['cat_id']}'>";
           echo $value;
           echo "</td>"; 

         }
         elseif ($key=='subCatName') {
           echo "<td id='$key{$table_product['id']}' data-id='{$table_product['sub_cat_id']}'>";
           echo $value;
           echo "</td>";   

         }
         elseif ($key=='market_name') {
          echo "<td id='$key{$table_product['id']}' data-id='{$table_product['market_id']}'>";
          echo $value;
          echo "</td>";
        }
        else{
         echo "<td id='$key{$table_product['id']}'>";
         echo $value;
         echo "</td>";
       }
     }
     echo "<th><button name='edit' class='btn btn-primary text-white edit_btn' data-id='{$table_product['id']}' class='btn btn-danger text-white delete' data-target='#add_update_Modal'>Edite</button></th>";
     echo "<th><button data-id='{$table_product['id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</button></th>";
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
    // event whene click Add product button to show add modal
    $("#add_product_Modal").click(function() {
      $("#subcategory_select").html("<option value='' disabled selected hidden>Please Choose SubCategory</option>");
     $("input:checkbox").attr("disabled",false);
     $("#img_upload").hide();
     $("#set_discount").attr("disabled",true);
     $('#add_update_form').trigger("reset");
     $("#update_product_btn").hide();
     $("#add_product_btn").show();
     $("#add_update_Modal").modal('show');

   });
    // valedtion
    $("#add_product_btn").click(function() { 
      var name =$("#set_name").val();
      var price=$("#set_price").val();
      var category=$("#category_select option:selected").val();
      var subcategory =$("#subcategory_select option:selected").val();
      var market=$("#market_select option:selected").val();
      var description=$("#set_desc").val();
      var discount=$("#set_discount").val();
      if(name==""){
        $("#name_star").html("*");
      } 
      else{
        $("#name_star").html("");
        $("#error").html("");
      }
      if(price==""){
        $("#price_star").html("*");
      } 
      else{
        $("#price_star").html("");
        $("#error").html("");
      }
      if(category==""){
        $("#cat_star").html("*");
      } 
      else{
        $("#cat_star").html("");
        $("#error").html("");
      }
      if(subcategory==""){
        $("#subcat_star").html("*");
      } 
      else{
        $("#subcat_star").html("");
        $("#error").html("");
      }
      if(market==""){
        $("#market_star").html("*");
      } 
      else{
        $("#market_star").html("");
        $("#error").html("");
      }
      if(description==""){
        $("#desc_star").html("*"); 
      } 
      else{
        $("#desc_star").html("");
        $("#error").html("");
      }
      if($("#set_discount").attr("disabled")==false && $("#sale").val()=='sale'){
       if(discount==""){
         $("#discount_star").html("*");
       } 
       else{
        $("#discount_star").html("");
        $("#error").html("");
      }
    }
    if(name==""||price==""||category==""||subcategory==""||market==""||description==""){
     $("#error").html("This fields is required.");
     return false;
   }

   var extension = $('#set_image').val().split('.').pop().toLowerCase();
   if(extension != '')
   {
     if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
     {
      $("#image_error").html("Invalid Image File");
      $('#set_image').val('');
      return false;
    }
    else{
      $("#image_error").html("");
    }
  } 
});
// delete product
   var row_id=0; //to save tr id
   // event whene click delete product button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });
     // event whene click yes button in delete product modal
     $("#delete_product_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=product & row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   // event whene click edit product button to update add modal
   $(".edit_btn").click(function() {
    row_id=$(this).attr('data-id');
    $("input").attr("disabled",false);
    $("input:checkbox").attr("checked",false);
    $("#set_image").attr("required",false);
    $('#add_update_form').trigger("reset");
    $("#add_product_btn").hide();
    $("#update_product_btn").show();
    $("#row_Id").val(row_id);
    $("#set_name").val($("#product_name"+row_id).html());
    $("#set_price").val($("#product_price"+row_id).html());
    $("#img_upload").attr("src","../plugins/images/product/"+$("#product_img"+row_id).attr("data-name"));
    $("#category_select").val($("#cat_name"+row_id).attr('data-id'));
    var id=$("#category_select").val();
    // ajaxs to all subcategory foe every main category
    $.ajax({
      type: 'GET',
      url: "../ajax/select_subCat.php?id="+id,
      success: function(returnData){
        $("#subcategory_select").append(returnData);
      }
    });   
    $("#subcategory_select").val($("#subCatName"+row_id).attr('data-id'));
    $("#market_select").val($("#market_name"+row_id).attr('data-id'));
    $("#set_desc").val($("#product_description"+row_id).html());

    // check box value
    if($("#featured_product"+row_id).html()=='featured'){
     $("#featured").attr('checked', true);
     $("input[name=soon]").attr("disabled",true);
   }
   if($("#coming_soon"+row_id).html()=='soon'){
     $("#soon").attr('checked', true);
     $("input[name=featured]").attr("disabled",true);
     $("input[name=sale]").attr("disabled",true);
   }
   if($("#sale"+row_id).html()=='sale'){
     $("#sale").attr('checked', true);
     $("#set_discount").attr("disabled",false);
     $("input[name=soon]").attr("disabled",true);
     //to calculate discount value
     var old_price= parseFloat($("#product_price"+row_id).html());
     var  new_price= parseFloat($("#new_price"+row_id).html());
     var discount_value=Math.round((old_price-new_price)*100/old_price);
     $("#set_discount").val(discount_value);
   }
   else if ($("#sale"+row_id).html()=='False'){
     $("#set_discount").attr("disabled",true);
     $("set_discount").val("");
   }

   $(".text-danger").html("");
   $(".modal-title").html("Update product");
   $("#add_update_Modal").modal('show');
 });

   // event whene click update button in update product modal 
   $("#update_product_btn").click(function() {
    var image_error =$("#image_error").html();
    var text_error= $("#error").html();
    var star=$("#name_star").html();
    var name =$("#set_name").val();
    var price=$("#set_price").val();
    var category=$("#category_select option:selected").val();
    var subcategory =$("#subcategory_select option:selected").val();
    var market=$("#market_select option:selected").val();
    var description=$("#set_desc").val();
    var discount=$("#set_discount").val();
    if(name==""){
      $("#name_star").html("*");
    } 
    else{
      $("#name_star").html("");
      $("#error").html("");
    }
    if(price==""){
      $("#price_star").html("*");
    } 
    else{
      $("#price_star").html("");
      $("#error").html("");
    }
    if(category==""){
      $("#cat_star").html("*");
    } 
    else{
      $("#cat_star").html("");
      $("#error").html("");
    }
    if(subcategory==""){
      $("#subcat_star").html("*");
    } 
    else{
      $("#subcat_star").html("");
      $("#error").html("");
    }
    if(market==""){
      $("#market_star").html("*");
    } 
    else{
      $("#market_star").html("");
      $("#error").html("");
    }
    if(description==""){
      $("#desc_star").html("*"); 
    } 
    else{
      $("#desc_star").html("");
      $("#error").html("");
    }
    if($("#set_discount").attr("disabled")==false && $("#sale").val()=='sale'){
      if(discount==""){
       $("#discount_star").html("*");   
     } 
     else{
      $("#discount_star").html("");
      $("#error").html("");
    }
  }
  if(name==""||price==""||category==""||subcategory==""||market==""||description==""){
   $("#error").html("This fields is required.");
   return false;
 }

 var extension = $('#set_image').val().split('.').pop().toLowerCase();
 if(extension != '')
 {
   if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
   {
    $("#image_error").html("Invalid Image File");
    $('#set_image').val('');
    return false;
  }
  else{
    $("#image_error").html("");
  }
} 
});
   $("#category_select").change(function() {
    var id=$(this).val();
    $.ajax({
      type: 'GET',
      url: "../ajax/select_subCat.php?id="+id,
      success: function(returnData){
        $("#subcategory_select").html(returnData);
      }
    });
  });
   $("input[name=soon]").on( "click", function() {
    if($(this).is(":checked")){
     $(this).val("soon");
     $("input[name=featured]").attr("disabled",true);
     $("input[name=sale]").attr("disabled",true);
     $("#set_discount").attr("disabled",true);
   }
   else if($(this).is(":not(:checked)")){
     $(this).val("False");
     $("input[name=featured]").attr("disabled",false);
     $("input[name=sale]").attr("disabled",false);
     $("#set_discount").attr("disabled",false);
   }
 });
   $("input[name=sale]").on( "click", function() {
    if($(this).is(":checked") || $("input[name=featured]").is(":checked")){
     $(this).val("sale");
     $("input[name=soon]").attr("disabled",true);
     $("#set_discount").attr("disabled",false);
     $("#set_discount").attr("required",true);
   }
   else if($(this).is(":not(:checked)")){
     $(this).val("False");
     $("input[name=soon]").attr("disabled",false);
     $("#set_discount").attr("disabled",true);
     $("#set_discount").attr("required",false);
   }
 });
   $("input[name=featured]").on( "click", function() {
    if($(this).is(":checked") ||$("input[name=sale]").is(":checked")){
     $(this).val("featured");
     $("input[name=soon]").attr("disabled",true);
   }
   else if($(this).is(":not(:checked)")){
     $(this).val("False");
     $("input[name=soon]").attr("disabled",false);
   }
 });

 });

</script>