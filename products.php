<?php include ("includes/header.php");
if(isset($_GET['id'])){
	$table =$_GET['table'];
	$row_id=$_GET['id'];
	if($_GET['table']=="category"){
		$column_name="cat_id";
	}
	elseif ($_GET['table']=="subcategory") {
		$column_name="sub_cat_id";
	}
	elseif ($_GET['table']=="market") {
		$column_name="market_id";
	}
	$id=$_GET['id'];
	$query_pro="select product.id, product_name, product_price, new_price, product_img,market_name, coming_soon,cat_id from product
	INNER JOIN market ON market.id = product.market_id 
	where $column_name=$id";
}
else {
	$query_pro="select product.id, product_name, product_price, new_price, cat_id,product_img,market_name,coming_soon from product INNER JOIN market ON market.id = product.market_id ";
	$table="";
	$row_id="";
}
$result_pro= mysqli_query($conn,$query_pro);
?>
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
				<div class="products-right-grid">
					<div class="products-right-grids">
						<div class="sorting">
							<select id="country"  class="frm-field required sect">
								<option value="default"><i class="fa fa-arrow-right" aria-hidden="true" selected=true></i>Default Sorting</option>
								<option value="new"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort By Newest</option> 	
								<option value="low"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort By Lowest Price</option> 				
								<option value="high"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort By Highest Price</option>								
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="agile_top_brands_grids">

					<!-- viwes product -->
					
				</div>
				<div class="clearfix"> </div>
				<nav class="numbering">
					<ul class="pagination paging">

						<?php 
						$number_pro=mysqli_num_rows($result_pro);
						$number_page=ceil($number_pro/9);
						for ($i=1; $i <=$number_page; $i++) { ?>
							<li class="paging_num"><a data-id="<?php echo $i;?>" id="pag_num<?php echo $i;?>">
								<?php echo $i;?></a></li>
							<?php }?>

						</ul>
					</nav>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>

		<?php include ("includes/footer.php");?>
		<script type="text/javascript">

			$(document).ready(function() {
				var page_num=1;
				var table_name=$("#table_name").val();
				var row_id=$("#row_id").val();
				var product_storts=$("#country").val();
				$.ajax({
					type: 'GET',
					url: "ajax/get_product.php?page_num="+page_num+"& table="+table_name+"&id="+row_id,
					success: function(returnData){
						$(".agile_top_brands_grids").html(returnData);
					}
				});

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
				$("#country").change(function () {
					var product_storts=$(this).val();
					page_num=1;
					$(".paging_num a").css({"background-color":"#fff","color":"#000"});

					$("#pag_num1").css({"background-color":"#fe9126","color":"#fff"});
					$.ajax({
						type: 'GET',
						url: "ajax/get_product.php?page_num="+page_num+"& table="+table_name+"&id="+row_id+"&product_storts="+product_storts,
						success: function(returnData){
							$(".agile_top_brands_grids").html(returnData);
							window.scrollTo(0, 200); 

						} 
					});
				});
			});
		</script>