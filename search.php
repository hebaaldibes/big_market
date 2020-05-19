<?php include ("includes/header.php");?>
<!----- to get table name and row_id and used in jquery ---->
<input type="text" id="row_id" value="<?php echo $row_id?>" hidden >
<input type="text" id="table_name" value="<?php echo $table?>" hidden>
<!---------------------------------------------------------->
<div class="products">
	<div class="container">
		<div class="col-md-4 products-left">
			<div class="categories">
				<h2>Categories</h2>
				<ul class="cate">
					<?php 
					$query = "select * from category";
					$result= mysqli_query($conn,$query);
					while($get_cat=mysqli_fetch_assoc($result)) {
						?>
						<li><?php echo "<a href='products.php?table=category&id={$get_cat['id']}'>";?><i class="fa fa-arrow-right" aria-hidden="true"></i><?php echo $get_cat['cat_name'];?></a></li>
						<ul>
							<?php 
							$query = "select * from subcategory where cat_id={$get_cat['id']}";
							$r_subcat= mysqli_query($conn,$query);
							while ($get_subcat=mysqli_fetch_assoc($r_subcat)) {
								echo "<li><a href='products.php?table=subcategory&id={$get_subcat['id']}'><i class='fa fa-arrow-right' aria-hidden='true'></i>{$get_subcat['subCatName']}</a></li>";}?>
							</ul>
						<?php }?>
					</ul>
				</div>																																												
			</div>
			<div class="col-md-8 products-right">
				<div class="agile_top_brands_grids">
					<!-- viwes product -->
					<?php 
					if(isset($_POST['search'])) { 
						$count_pro=0;
						$search = $_POST['search'];
						$query_search="select product.id, product_name, product_price, new_price, product_img,market_name, coming_soon,cat_id from product
						INNER JOIN market ON market.id = product.market_id 
						WHERE product_name like '%$search%'";
						$result_search = mysqli_query($conn,$query_search);

						while($get_pro=mysqli_fetch_assoc($result_search)) {
							$count_pro=$count_pro+1;
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
						if($count_pro==0){?>
							<div style="margin-left: 50px">
								<img src='images/unnamed.png' class='img-responsive'>
							</div>				
						<?php }}?>



					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

		<?php include ("includes/footer.php");?>
		<script type="text/javascript">

		</script>