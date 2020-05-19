<?php include ("includes/header.php");
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$cat_id=$_GET['cat_id'];
	$query_pro="select product.id, product_name, product_price, new_price,product_img,market_name, coming_soon,product_description from product
	INNER JOIN market ON market.id = product.market_id 
	where product.id=$id";
	$result= mysqli_query($conn,$query_pro);
	$get_pro=mysqli_fetch_assoc($result);
	$old_price=$get_pro['product_price'];
	$price=$get_pro['new_price'];
	if($price==0){
		$price=$old_price;
		$old_price="";
	}
}
?>

<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
			<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
			<li class="active">Singlepage</li>
		</ol>
	</div>
</div>
<!-- //breadcrumbs -->
<div class="products">
	<div class="container">
		<div class="agileinfo_single">

			<div class="col-md-4 agileinfo_single_left">
				<?php echo "<img id='example' class='img-responsive' title='{$get_pro['product_name']}' alt='{$get_pro['product_name']}' src='p/plugins/images/product/{$get_pro['product_img']}' width='300px' height='300px'/>";?>
			</div>
			<div class="col-md-8 agileinfo_single_right">
				<h2><?php echo $get_pro['product_name'];?></h2>
				<h5>Market Name :<?php echo $get_pro['market_name'];?></h5>
				<div class="w3agile_description">
					<h4>Description :</h4>
					<p><?php echo $get_pro['product_description'];?></p>
				</div>
				<div class="snipcart-item block">
					<div class="snipcart-thumb agileinfo_single_right_snipcart">
						<h4 class="m-sing"><b>$<?php echo $price;?> <span><?php echo $old_price;?></span></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							<form action="#" method="post">
								<fieldset>
									<input  name='product_id' type='hidden' value='<?php echo $get_pro['id']?>'>
									<input type="submit" name="addtocart" value="Add to cart" class="button mani_cart_btn"<?php if($get_pro['coming_soon']=='soon'){echo "hidden";}?>/>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- new -->
	<div class="newproducts-w3agile">
		<div class="container">
			<h3>New offers</h3>
			<div class="agile_top_brands_grids">
				<?php 
				$query = "select product.id, product_name, product_price, new_price, cat_id,coming_soon,product_img,market_name from product
				INNER JOIN market ON market.id = product.market_id 
				where sale='sale' AND cat_id=$cat_id
				LIMIT 4";
				$result= mysqli_query($conn,$query);
				while($get_pro=mysqli_fetch_assoc($result)) {
					if($get_pro['coming_soon']=='soon'){
						continue;
					}
					?>
					<div class="col-md-3 top_brand_left-1">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid_pos">
									<img src="images/offer.png" alt=" " class="img-responsive">
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<?php
												echo "<a href='single.php?id={$get_pro['id']}&cat_id={$get_pro['cat_id']}'><img title='{$get_pro['product_name']}' alt='{$get_pro['product_name']}' src='p/plugins/images/product/{$get_pro['product_img']}' width='150px' height='150px'/></a>";?>	
												<p><b><?php echo $get_pro['product_name'];?></b></p>
												<p><?php echo $get_pro['market_name'];?></p>
												<h4>$<?php echo $get_pro['new_price'];?><span>$<?php echo $get_pro['product_price'];?></span></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<form action="#" method="post">
													<fieldset>
														<input  name='product_id' type='hidden' value='<?php echo $get_pro['id']?>'>
														<input type="submit" name="addtocart_shop" value="Add to cart" class="button mani_cart_btn"/>
													</fieldset>
												</form>
											</div>
										</div>
									</figure>
								</div>
							</div>
						</div>
						<br>
					</div>
				<?php }?>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //new -->
	<!-- //footer -->
	<?php include ("includes/footer.php");?>