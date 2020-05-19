 <?php include ("includes/header.php");
//vister website counts 
$query="select * from user_count";
$result= mysqli_query($conn,$query);
$total_visetor=mysqli_num_rows($result);

$total_visites=0;
$total_pages_views=0;
while ($row = mysqli_fetch_assoc($result)){
$total_visites = $total_visites+$row['total_visites'];
$total_pages_views=$total_pages_views+$row['pages_views'];
}

//orders counts
$query="select * from customer_order GROUP BY order_id";
$result= mysqli_query($conn,$query);
$total_orders=mysqli_num_rows($result);
 ?>
 <!-- ============================================================== -->
 <!-- Page Content -->
 <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Visit</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash"></div>
                            </li>
                            <li class="text-right"><span class="counter text-success"><?php echo $total_visites?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Page Views</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash2"></div>
                            </li>
                            <li class="text-right"><span class="counter text-purple"><?php echo $total_pages_views?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Unique Visitor</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash3"></div>
                            </li>
                            <li class="text-right"><span class="counter text-info"><?php echo $total_visetor?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Orders</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash3"></div>
                            </li>
                            <li class="text-right"><span class="counter text-info"><?php echo $total_orders?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/.row -->
                    <!-- ============================================================== -->
                    <!-- table -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="white-box">
                                <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                                    <select class="form-control pull-right row b-none" id="date_select">
                                        <option value="3">March 2020</option>
                                        <option value="4">April 2020</option>
                                    </select>
                                </div>
                                <h3 class="box-title">Top 10 best selling products</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAME</th>
                                                <th>IMAGE</th>
                                                <th>MARKET</th>
                                                <th>PRICE</th>
                                                <th>QUANTITY</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pro_tbody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- chat-listing & recent comments -->
                    <!-- ============================================================== -->
               
                        <!-- /.col -->
<?php include 'includes/footer.php';?>

<!-- javascript section -->
<script type="text/javascript">
    $(document).ready(function() {
        var d = new Date();
        var year=d.getFullYear();
        var month=d.getMonth();
       var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
       if($("#date_select option:last-child").val()!=month+1){
        $("#date_select").append("<option value='"+(month+1)+"' selected>"+months[month]+" "+year+"</option>")
       }
       $("#date_select").change(function() {
        date_selected=$("#date_select").val();
    // event whene change date select value
       $.ajax({
         url: "../ajax/date_selected.php?date_selected="+date_selected,
         success: function(data)
         {
       $("#pro_tbody").html(data);// show response from the php script.
      }
    });
     });
           $.ajax({
         url: "../ajax/date_selected.php?date_selected="+$("#date_select").val(),
         success: function(data)
         {
       $("#pro_tbody").html(data);// show response from the php script.
      }
    });
       });
</script>