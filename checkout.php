<?php
ob_start();
include_once ("includes/header.php");
$total=0;
$count=0;
?>

<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1">
			<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Checkout Page</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<!-- checkout -->
<div class="checkout">
	<div class="container">
		<h2>Your shopping cart contains: <span><?php echo count($productCart);?> Products</span></h2>
		<div class="checkout-right">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>SL No.</th>	
						<th>Product</th>
						<th>Quality</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>SubTotal Price</th>
						<th>Remove</th>
					</tr>
				</thead>
				<?php $total=0;
				$count=0;
				foreach ($productCart as $single_product) {
					$count++;
					$old_price=$single_product['product_price'];
					$price=$single_product['new_price'];
					if($price==0){
						$price=$old_price;
						$old_price="";
					}
					?> 
					<tr id="cart-product<?php echo $single_product['id'];?>">
						<td class="invert count_num"><?php echo $count;?></td>
						<td class="invert-image">
							<?php echo "<a href='single.php?id={$single_product['id']}&cat_id={$single_product['cat_id']}'><img title='{$single_product['product_name']}' alt='{$single_product['product_name']}' src='p/plugins/images/product/{$single_product['product_img']}' width='150px' height='150px' class='img-responsive'/></a>";?>
						</td>
						<td class="invert">	                         
							<input type="number" name="qty" min="1" max="10" style="width: 70px;" class="product-quantity" value="<?php echo $_SESSION["qty"][$single_product['id']];?>" data-id="<?php echo $single_product['id']?>">
						</td>
						<td class="invert"><?php echo $single_product['product_name'];?></td>
						<td class="invert">$<span id="price_pro<?php echo $single_product['id']?>"><?php echo $price;?></span></td>

						<?php $total=$total+($price*$_SESSION["qty"][$single_product['id']]);?>

						<td class="invert">$<span id="subtotal<?php echo $single_product['id']?>"><?php echo $price*$_SESSION["qty"][$single_product['id']];?></span></td>
						<td title="Remove from Cart" class="text-center">
							<button data-id="<?php echo $single_product['id']?>" class="btn btn-xs btn-danger my-product-remove remove">X</button></td>
						</tr>
					<?php }?>

				</table>
			</div>

			<div class="checkout-left">	
				<div class="checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						<li><h5>Cash on Delivery</h5></li>
						<li>Total <i>-</i><span>$<span class="total"><?php echo $total?></span></span></li>
						<li>Total Service Charges <i>-</i><span>$<span id="delivery">10.00</span></span></li>
						<li>All Total <i>-</i><span>$<span class="all_total"><?php echo $total  +10.00 ?></span></span></li>
						<li class="text-center">
							<form method="post">
								<button type="" class="btn btn-primary btn-lg" id="placeOrder" name="placeOrder">Place Order</button>
							</form>
						</li>
					</ul>
					<?php 
					if (isset($_POST['placeOrder'])) {
						if (count($productCart)>0) {
							if (isset($_SESSION['login_user'])) {
								$order_id=rand();

								foreach ($productCart as $single_product) {
									$query_ord= "insert into customer_order(order_id, customer_id, product_id,quantity)
									VALUES ($order_id,{$_SESSION['login_user']['cast_id']},{$single_product['id']}, {$_SESSION["qty"][$single_product['id']]})";
									mysqli_query($conn,$query_ord);
									
								}
								unset($_SESSION["product"]);
								unset($_SESSION["qty"]);
								header("location:orders.php");
							}
							else{
								echo "<div class='alert alert-danger' role='alert'>
								<span>Sorry you are not login! </span><a href='login.php' class='btn btn-danger btn-sm'>Login</a>
								</div>";
							}
						}
						else{
							echo "<div class='alert alert-danger' role='alert'>
							<span>Your cart is empty! </span><a href='products.php' class='btn btn-danger btn-sm'>Shopping</a>
							</div>";
						}
					}		
					?>
				</div>

				<div class="checkout-right-basket">
					<a href="products.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
                    <br><br>
					<a href="orders.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span  style="padding-right: 38px">Orders Details</span></a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //footer -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".product-quantity").change(function() {
				var product_id=$(this).attr("data-id");
				var price=parseFloat($("#price_pro"+product_id).html());
				var subtotal=parseFloat($("#subtotal"+product_id).html());
				var qty=$(this).val();
				var total=price*qty; 
				$("#subtotal"+product_id).html(total.toFixed(2));
				var all_total =parseFloat($(".all_total").html())-subtotal+total;
				$(".all_total").html(all_total.toFixed(2));
				$(".total").html(all_total.toFixed(2));
				$.ajax({
					type: 'GET',
					url: "ajax/change_qty.php?product_id="+product_id+"&qty="+qty,
				});
			});
			$('.remove').on('click', function(c){
				var pro_id=$(this).attr("data-id");
				var subtotal=parseFloat($("#subtotal"+pro_id).html());
				var  all_total =parseFloat($(".all_total").html())-subtotal;
				$.ajax({
					type: 'GET',
					url: "ajax/delete_product.php?product_id="+pro_id,
					success: function(returnData){
						$("#cart-product"+pro_id).fadeOut('slow', function(c){
							$(".all_total").html((all_total+10).toFixed(2));
							$(".total").html(all_total.toFixed(2));
							$("#cart-product"+pro_id).hide();

						});
					}
				});
			});
		});
	</script> 
	<?php include ("includes/footer.php");?>
