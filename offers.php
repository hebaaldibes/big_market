<?php include ("includes/header.php");?>
<div class="top-brands">
	<div class="container">
		<h2>Top selling offers</h2>
		<div class="grid_3 grid_5">
			<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Advertised offers</a></li>
					<li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Today Offers</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
						<div class="agile-tp">
							<h5>Advertised this week</h5>
							<p class="w3l-ad">We've pulled together all our advertised offers into one place, so you won't miss out on a great deal.</p>
						</div>
						<div class="agile_top_brands_grids">
							<?php 
							$query = "select product.id, product_name, product_price, new_price, coming_soon,cat_id,product_img,market_name from product
							INNER JOIN market ON market.id = product.market_id 
							where sale='sale'
							ORDER BY new_price ASC";
							$result= mysqli_query($conn,$query);
							while($get_pro=mysqli_fetch_assoc($result)) {
								?>
								<div class="col-md-4 top_brand_left">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="images/offer.png" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
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

					<div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
						<div class="agile-tp">
							<h5>Advertised today</h5>
							<p class="w3l-ad">We've pulled together all our advertised offers into one place, so you won't miss out on a great deal.</p>
						</div>
						<div class="agile_top_brands_grids">
							<?php 
							$date_of_today=date("Y-m-d");
							$query = "select product.id, product_name, product_price, new_price, coming_soon,cat_id,product_img,market_name from product
							INNER JOIN market ON market.id = product.market_id 
							where sale='sale' AND date_sale='$date_of_today'
							ORDER BY new_price ASC";
							$result= mysqli_query($conn,$query);
							while($get_pro=mysqli_fetch_assoc($result)) {
								?>
								<div class="col-md-4 top_brand_left">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="images/offer.png" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<div class="snipcart-item block" >
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
					</div>
				</div>
			</div>
		</div>
<?php include ("includes/footer.php");?>
