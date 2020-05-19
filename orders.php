<?php include ("includes/header.php");
if (isset($_SESSION['login_user'])) {
	$query = "SELECT * FROM customer_order WHERE customer_id='{$_SESSION['login_user']["cast_id"]}' GROUP BY order_id,order_date
	      ORDER BY order_date DESC";
	$result= mysqli_query($conn,$query);
	?>

	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Orders Details</li>
			</ol>
		</div>
	</div>
	<!-- //breadcrumbs -->
	<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h2>Your orders details</h2>
				<?php while ($orders=mysqli_fetch_assoc($result)){?>
					<div class="checkout-right">
						<table width="200%">
							<tr height='20px'>
							<td><h5>Order Id : <?php echo  $orders['order_id'];?></h5></td>
							<td><h5>Order date : <?php echo  $orders['order_date'];?></h5></td>
						</tr>
						</table>
						<table class="timetable_sub">
							<thead>
								<tr>
									<th>SL No.</th>	
									<th>Product</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>SubTotal Price</th>
									<th>Quality</th>
								</tr>
							</thead>
							<?php 
							$query_pro ="select product.product_name,product.product_price,quantity,product.product_img,product.cat_id,product.id from customer_order 
							INNER JOIN product  
							on product_id =  product.id
							WHERE order_id={$orders['order_id']}";

							$pro_order= mysqli_query($conn,$query_pro);
							$total=0;
							$sub_total=0;
							$count=0;
							while ($pro_orders=mysqli_fetch_assoc($pro_order)){
								$count++;
								$sub_total=$pro_orders['product_price']*$pro_orders['quantity'];
								$total=$total+$sub_total;?>
								<tr class="rem1">
									<td class="invert">$count</td>
									<td class="invert-image"><?php echo "<a href='single.php?id={$pro_orders['id']}&cat_id={$pro_orders['cat_id']}'><img title='{$pro_orders['product_name']}' alt='{$pro_orders['product_name']}' src='p/plugins/images/product/{$pro_orders['product_img']}' width='100px' height='100px' class='img-responsive'/></a>";?>
								</td>

								<td class="invert"><span><?php echo  $pro_orders['product_name'];?></span></td>
								<td class="invert"><span>$<?php echo $pro_orders['product_price'];?></span></td>
								<td class="invert"><span><?php echo  $pro_orders['quantity'];?></span></td>
								<td class="invert"><span>$<?php echo  $sub_total;?></span></td>
							</tr>
						<?php }?>
						<tfoot>
							<tr>
								<th style="text-align: left;">Total Service Charges</th>
								<th colspan="6" style="text-align: right;">$10</th>
							</tr>
							<tr>
								<th style="text-align: left;">Total</th>
								<th colspan="6" style="text-align: right;">$<?php echo $total+10;?></th>
							</tr>
						</tfoot>								
					</table>
				</div>
				<br>
			<?php }}?>	
		</div>
	</div>
	<?php include ("includes/footer.php");?>