 <?php include ("includes/header.php");?>
 <!-- ============================================================== -->
 <!-- Page Content -->
 <!-- ============================================================== -->
 <!-- delete Modal -->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete orders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Are you sure to delete this item?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleteorders_btn">Yes</button>
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
    <h3 class="box-title">Manage Orders</h3>
    <div class="table-responsive">
         <?php
      $query = "SELECT * FROM customer_order  
      INNER JOIN customer on customer_id = customer.id
      GROUP BY order_id,order_date
      ORDER BY order_date DESC";
      $result= mysqli_query($conn,$query);
      while ($orders=mysqli_fetch_assoc($result)){?>
        <table class="table">
      <thead style="background: #f33155;">
        <?php
        echo "<tr id={$orders['order_id']}>";    
        echo "<th style='color: #fff;'>Order ID: {$orders['order_id']}</th>";
        echo "<th style='color: #fff;'>Customer Name: {$orders['customer_name']}</th>";
        echo "<th style='color: #fff;'>Order Date: {$orders['order_date']}</th>";
        ?>
      </tr>
    </thead>
    <tbody> 
   
     <?php
        // to get products order 
        $query_pro ="select product.product_name,product.product_price,quantity,product.product_img,product.cat_id,product.id from customer_order 
        INNER JOIN product  
        on product_id =  product.id
        WHERE order_id={$orders['order_id']}";?>
        <tr>
           <table class="table">
            <thead>
             <tr>
              <th>#</th>
              <th>Poduct Image</th>
              <th>Poduct Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>SubTotal</th>
            </tr>
          </thead>
          <tbody>
            <?php $pro_order= mysqli_query($conn,$query_pro);
            $sub_total=0;
            $total=0;
            $count=0;
            while ($pro_orders=mysqli_fetch_assoc($pro_order)){
             $count++;
             $sub_total=$pro_orders['product_price']*$pro_orders['quantity'];
             $total=$total+$sub_total;
             echo "<tr>";
             echo "<td>$count</td>";
             echo "<td><img title='{$pro_orders['product_name']}' alt='{$pro_orders['product_name']}' src='../plugins/images/product/{$pro_orders['product_img']}' width='5px' height='5px'/>
             </td>";
             echo "<td><span>{$pro_orders['product_name']}</span></td>";
             echo "<td>$<span>{$pro_orders['product_price']}</span></td>";
             echo "<td><span>{$pro_orders['quantity']}</span></td>";
             echo "<td>$<span>$sub_total</span></td>";
             echo "</tr>";      
           }?>

         </tbody>
         <tfoot><tr><th colspan="5"><?php echo "<span>Total: $</span>$total";?></th>
          <th><?php echo "<a href='#' data-id='{$orders['order_id']}' class='btn btn-danger text-white delete_btn' data-toggle='modal' data-target='#deleteModal'>Delete</a>";?></th>
          <tr></tfoot>
          </table>
      </tr>

      <?php
 
 echo "</tbody></table>";
    }
    ?>

</div>
</div>
</div>
</div>

<?php include 'includes/footer.php';?>

<script type="text/javascript">
	$(document).ready(function() {

   var row_id=0; //to save tr id
   // event whene click delete orders button to show delete modal
   $(".delete_btn").click(function() {
     row_id=$(this).attr('data-id');
   });
     // event whene click yes button in delete orders modal
     $("#deleteorders_btn").click(function() {
       $.ajax({
         url: "includes/delete.php?table_name=customer_order& row_id="+row_id,
         success: function(data)
         {
        $("#"+data).hide();// show response from the php script.
      }
    });
       $("#deleteModal").modal('hide');
     });

   });
 </script>