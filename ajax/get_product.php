<?php require ("../includes/connection.php");?>
<?php
    $product_storts="";
if(isset($_GET['product_storts'])){
	$how_stort=$_GET['product_storts'];
if($how_stort=="high"){
$product_storts='ORDER BY product_price DESC';
}
elseif ($how_stort=="low") {
$product_storts='ORDER BY product_price ASC';
}
elseif ($how_stort=="new") {
$product_storts='ORDER BY date_set DESC';
}
}
if(isset($_GET['page_num'])){
	$paging_num=$_GET['page_num'];
	
	$off_set=9*($paging_num-1);

	if($_GET['id'] !=""){
		$table =$_GET['table'];
		$row_id=$_GET['id'];
		if($table=="category"){
		$column_name="cat_id";
		}
		elseif ($table=="subcategory") {
			$column_name="sub_cat_id";
		}
		elseif ($table=="market") {
			$column_name="market_id";
		}
		$query_pro="select product.id, product_name, product_price, new_price, product_img,market_name, coming_soon,cat_id from product
		INNER JOIN market ON market.id = product.market_id 
		where $column_name=$row_id 
		$product_storts
		 LIMIT $off_set, 9";
	}
	else {
		$query_pro="select product.id, product_name, product_price, new_price, cat_id,product_img,market_name,coming_soon from product INNER JOIN market ON market.id = product.market_id 
		$product_storts
		 LIMIT $off_set,9";
	}
	$result_pro= mysqli_query($conn,$query_pro);
	while($get_pro=mysqli_fetch_assoc($result_pro)) {
		$old_price=$get_pro['product_price'];
		$price=$get_pro['new_price'];
		$img_offer="<img src='images/offer.png' class='img-responsive'>";
		if($price==0){
			$price=$old_price;
			$old_price="";
			$img_offer="";
		}
			echo "<div class='col-md-4 top_brand_left'>
							<div class='hover14 column'>
								<div class='agile_top_brand_left_grid'>
									<div class='agile_top_brand_left_grid_pos'>
										$img_offer
									</div>
									<div class='agile_top_brand_left_grid1'>
										<figure>
											<div class='snipcart-item block'>
												<div class='snipcart-thumb'>
													<a href='single.php?id={$get_pro['id']}&cat_id={$get_pro['cat_id']}'><img title='{$get_pro['product_name']}' alt='{$get_pro['product_name']}' src='p/plugins/images/product/{$get_pro['product_img']}' width='150px' height='150px'/></a>
													<p><b> {$get_pro['product_name']}</b></p>
													<p>{$get_pro['market_name']}</p>
													<h4>$ $price
													<span class='old_price'>$old_price</span>
													</h4>
												</div>
												<div class='snipcart-details top_brand_home_details'>
													<form action='#' method='post'>
														<fieldset>

															<input  name='product_id' type='hidden' value='{$get_pro['id']}'>
															<input type='submit' name='addtocart_shop' class='button mani_cart_btn'";?> <?php if($get_pro['coming_soon']=='soon'){
																echo "value='Comming Soon'";
																echo "disabled=true";
															}else{
																echo "value='Add to cart'";
															} 						
														echo "/></fieldset>
													</form>
												</div>
											</div>
										</figure>
									</div>
								</div>
							</div>
							<br>
						</div>";
						
		
	}
}

		?>