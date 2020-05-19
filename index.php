<?php include_once ("includes/header.php");?>
<!-- //navigation -->
<!-- main-slider -->

<ul id="demo1">
	<div class="sli">
		<li class="s1">
			<div>
				<img src="images/11.jpg">
				<h3>Buy Rice Products Are Now On Line With Us</h3>
			</div>
		</li>
		<li class="s2">
			<div>
				<img src="images/22.jpg">
				<h3>Buy from multi stores in one place</h3>
			</div>
		</li>
		<li  class="s3">
			<div>
				<img src="images/44.jpg">
				<h3>Buy from multi stores in one place</h3>
			</div>
		</li>
	</div>
</ul>
<!-- //main-slider -->
<!-- //top-header and slider -->
<!-- top-brands -->
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
							where sale='sale' LIMIT 9";
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
															<form method="post">
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
							<div class="text-center">
								<h4>
								<a href="offers.php" style="color: #fe9126">See More</a>
							   </h4>
							</div>	
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
							where sale='sale' AND date_sale='$date_of_today' LIMIT 9";
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
									<div class="text-center">
								<h4>
								<a href="offers.php" style="color: #fe9126">See More</a>
							   </h4>
							</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- //top-brands -->
 <!-- Carousel
 	================================================== -->
 	<div id="myCarousel" class="carousel slide" data-ride="carousel">
 		<!-- Indicators -->
 		<ol class="carousel-indicators">
 			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
 			<li data-target="#myCarousel" data-slide-to="1"></li>
 			<li data-target="#myCarousel" data-slide-to="2"></li>
 		</ol>
 		<div class="carousel-inner" role="listbox">
 			<div class="item active">
 				<img class="first-slide" src="images/b1.jpg" alt="First slide">

 			</div>
 			<div class="item">
 				<img class="second-slide " src="images/b3.jpg" alt="Second slide">

 			</div>
 			<div class="item">
 				<img class="third-slide " src="images/b1.jpg" alt="Third slide">

 			</div>
 		</div>

 	</div><!-- /.carousel -->	
 	<!--banner-bottom-->
 	<div class="newproducts-w3agile">
 		<div class="container">
 			<h3>featured</h3>
 			<div class="agile_top_brands_grids">
 				<?php
 				$query = "select product.id, product_name, product_price, new_price, coming_soon,cat_id,product_img,market_name from product
 				INNER JOIN market ON market.id = product.market_id 
 				where featured_product='featured'";
 				$result= mysqli_query($conn,$query);
 				while($get_pro=mysqli_fetch_assoc($result)) {
 					?>
 					<div class="col-md-3 top_brand_left-1">
 						<div class="hover14 column">
 							<div class="agile_top_brand_left_grid">
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
 														<h4>$<?php echo $get_pro['product_price'];?></h4>
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
 			<!--banner-bottom-->
 			<!--brands-->
 			<div class="brands">
 				<div class="container">
 					<h3>Brand Store</h3>
 					<div class="brands-agile">
 						<?php
 						$query = "select * from market";
 						$result= mysqli_query($conn,$query);
 						while($get_market=mysqli_fetch_assoc($result)) {
 							?>
 							<div class="col-md-2 w3layouts-brand">
 								<div class="brands-w3l">
 									<p><?php echo "<a href='products.php?table=market&id={$get_market['id']}'>";
 									if($get_market['market_logo']){?><img src="p/plugins/images/market/<?php echo $get_market['market_logo'];?>" width='100px' height="60px"><?php }else{echo "<span style='line-height:60px'>{$get_market['market_name']}</span>";}
 									?></a></p><br/>
 								</div>
 							</div>
 						<?php }?>
 						<div class="clearfix"></div>
 					</div>
 				</div>
 			</div>	
 			<!--//brands-->
 			<!-- new -->
 			<div class="newproducts-w3agile">
 				<div class="container">
 					<h3>Comming soon</h3>
 					<div class="agile_top_brands_grids">
 						<?php
 						$query = "select product.id, product_name, product_price, new_price, cat_id,product_img,market_name from product
 						INNER JOIN market ON market.id = product.market_id 
 						where coming_soon='soon'";
 						$result= mysqli_query($conn,$query);
 						while($get_pro=mysqli_fetch_assoc($result)) {
 							?>
 							<div class="col-md-3 top_brand_left-1">
 								<div class="hover14 column">
 									<div class="agile_top_brand_left_grid">
 										<div class="agile_top_brand_left_grid_pos">
 											<img src="images/soon.png" alt=" " class="img-responsive" />
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
 																<h4>$<?php echo $get_pro['product_price'];?></h4>
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
<script type="text/javascript">
	$(document).ready(function() {
						$(".paging_num a").click(function() {
					$(".paging_num a").css({"background-color":"#fff","color":"#000"});
					$(this).css({"background-color":"#fe9126","color":"#fff"});
					page_num= $(this).attr('data-id');
					var product_storts=$("#country").val();
					$.ajax({
						type: 'GET',
						url: "ajax/get_product.php?page_num="+page_num+"& table="+table_name+"&id="+row_id+"&product_storts="+product_storts,
						success: function(returnData){
							$(".agile_top_brands_grids").html(returnData);
							window.scrollTo(0, 200); 

						}
					});
	});
</script>