<?php require ("includes/connection.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//adding new visitor
$visitor_ip=$_SERVER['REMOTE_ADDR'];
$query="select * from user_count where ip_address='$visitor_ip'";
$result= mysqli_query($conn,$query);
$total_visetor=mysqli_num_rows($result);

// check if visitor is unique
if ($total_visetor<1) {
	$query="INSERT INTO user_count(ip_address) VALUES ('$visitor_ip')";
	$result= mysqli_query($conn,$query);
}

if(isset($_SESSION['visitor'])){
	$query="UPDATE user_count SET pages_views = pages_views+1 WHERE ip_address='$visitor_ip'";	
	$result= mysqli_query($conn,$query);
}
else{
	$query="UPDATE user_count SET total_visites = total_visites+1,
	pages_views = pages_views+1
	WHERE ip_address='$visitor_ip'";
	$result= mysqli_query($conn,$query);
	$_SESSION['visitor']=$visitor_ip;
}

// to add to cart
$productCart=array();
$count=0;

if (isset($_POST['addtocart'])||isset($_POST['addtocart_shop'])) {
    //add current product to inside session
	$productID=$_POST['product_id'];

	if(isset($_SESSION["product"][$productID])){
		$_SESSION["qty"][$productID]=$_SESSION["qty"][$productID]+1;
	}
	$_SESSION["product"][$productID]= $productID;	
	

}
if(isset($_SESSION["product"])){
	foreach ($_SESSION["product"] as $pro_id) {
		$query="select product.id, product_name, product_price, new_price,product_img,cat_id,market_name
		from product
		INNER JOIN market ON market.id = product.market_id 
		where product.id=$pro_id";
		$result= mysqli_query($conn,$query);
		while ($row = mysqli_fetch_assoc($result)) {
			$productCart[]=$row;
			if(isset($_SESSION["qty"])){
				if(!isset($_SESSION["qty"][$row['id']])){
					$_SESSION["qty"][$row['id']] = 1;
				}
			}
			else {
				$_SESSION["qty"][$row['id']] = 1;
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Big Market-Online Shopping </title>
	<!-- for-mobile-apps -->
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/custom.css" media="all" />
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons -->
	<style type="text/css">
		.login-form-grids input,.login-form-grids textarea{
			outline: none;
			border: 1px solid #DBDBDB;
			padding: 10px 10px 10px 10px;
			margin-top: 10px;
			font-size: 14px;
			color: #999;
			display: block;
			width: 100%;
		}
		.number_input::-webkit-inner-spin-button {
			-webkit-appearance: none;
		}
		#pag_num1{
			background-color:#fe9126;
			color: #fff;
		}
		.paging_num{
			cursor: pointer;
		}
	</style>
	<!-- js -->
	<script src="js/jquery-2.2.4.min.js"></script>
	<!-- //js -->
	<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
</head>

<body>
	<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="products.php">SHOP NOW</a></p>
			</div>
			<div class="agile-login">
				<ul><?php if (isset($_SESSION['login_user'])) {	
					echo "<li><a href='profile.php'>Hi,{$_SESSION['login_user']["username"]}</a></li>"; 	
					echo "<li><a href='logout.php'>Logout</a></li>"; 
				}
				else { ?>
					<li><a href="registered.php"> Create Account </a></li>
					<li><a href='login.php'>Login</a></li>
				<?php } ?>	
			</ul>
		</div>
		<div class="product_list_header">  

			<button class="w3view-cart" type="button" name="button" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>

		</div>
		<div class="clearfix"> </div>
	</div>
</div>

<div class="logo_products">
	<div class="container">
		<div class="w3ls_logo_products_left1">
			<ul class="phone_email">
				<li><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : (+0123) 234 567</li>

			</ul>
		</div>
		<div class="w3ls_logo_products_left">
			<h1><a href="index.php">Big Market</a></h1>
		</div>
		<div class="w3l_search">
			<form action="search.php" method="post">
				<input type="search" name="search" placeholder="Search for a Product..." required="">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true" name="search_btn"> </i>
				</button>
				<div class="clearfix"></div>
			</form>
		</div>

		<div class="clearfix"> </div>
	</div>
</div>
<!-- //header -->
<!-- navigation -->
<div class="navigation-agileits">
	<div class="container">
		<nav class="navbar navbar-default">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header nav_2">
				<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div> 
			<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php" class="act">Home</a></li>	
					<!-- Mega Menu -->
					<!-- get main category and subcategory-->
					<?php 
					$query = "select * from category";
					$result= mysqli_query($conn,$query);
					while($get_cat=mysqli_fetch_assoc($result)) {
						?>
						<li class="dropdown">
							<a href="products.php?table=category&id={$get_cat['id']}'" class="dropdown-toggle" data-toggle="dropdown"><?php echo $get_cat['cat_name'];?><b class="caret"></b></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="multi-gd-img">
										<ul class="multi-column-dropdown">
											<?php echo "<a href='products.php?table=category&id={$get_cat['id']}'>";?><h6>All <?php echo $get_cat['cat_name'];?></h6></a>
											<?php 
											$query = "select * from subcategory where cat_id={$get_cat['id']}";
											$r_subcat= mysqli_query($conn,$query);
											while ($get_subcat=mysqli_fetch_assoc($r_subcat)) {

												echo "<li><a href='products.php?table=subcategory&id={$get_subcat['id']}'>{$get_subcat['subCatName']}</a></li>";
											}

											?>
										</ul>
									</div>	

								</div>
							</ul>
						</li>
					<?php }?>
					<li><a href="offers.php">Offers</a></li>
				</ul>
			</div>
		</nav>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="mani_cart_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="catr_body">
				<div class="modal-body">
					<?php if(isset($_SESSION["product"])){
						foreach ($productCart as $single_product) {
							$old_price=$single_product['product_price'];
							$price=$single_product['new_price'];
							if($price==0){
								$price=$old_price;
								$old_price="";
								$img_offer="";
							}

							?>

							<table class="table table-hover table-responsive" id="cart-table<?php echo $single_product['id'];?>">
								<tbody>
									<tr>
										<td class="text-center" width="20%"><img width="50px" height="50px" src="p/plugins/images/product/<?php echo $single_product['product_img'];?>">
										</td>
										<td width="20%">
											<?php echo $single_product['product_name'];?>
										</td>
										<td title="Unit Price" width="15%">
											$<span id="price<?php echo $single_product['id']?>"><?php echo $price;?></span>
										</td>
										<td title="Quantity" width="20%">
											<input type="number" name="qty" min="1" max="10" style="width: 70px;" class="my-product-quantity" value="<?php echo $_SESSION["qty"][$single_product['id']];?>" data-id="<?php echo $single_product['id']?>">
										</td>
										<?php $count=$count+($price*$_SESSION["qty"][$single_product['id']]);?>
										<td title="Total" class="my-product-total" width="15%">$<span id="total<?php echo $single_product['id']?>"><?php echo $price*$_SESSION["qty"][$single_product['id']];?></span></td>
										<td title="Remove from Cart" class="text-center" width="10%"><button data-id="<?php echo $single_product['id']?>" class="btn btn-xs btn-danger my-product-remove">X</button></td>
									</tr>
								</tbody>
							</table>
						<?php }}
						else{
							echo "<h3 class='text-center'>The Cart is Empty!</h3>";
						} 
						if(count($_SESSION["product"])==0){
							echo "<h3 class='text-center'>The Cart is Empty!</h3>";
						}
						?>
					</div>
				</div>
				<div class="modal-footer" width="100%">        
					<div class="pull-left"> 
						<h4 class="float-left"> Subtotal: $<span class="all_total"><?php echo "$count";?></span></h4> 
					</div>
					<a href="checkout.php" class="btn btn-primary btn-lg">Check out</a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".w3view-cart").click(function() {
				$('#mani_cart_modal').modal('show');
			});

			$(".my-product-quantity").change(function() {
				var product_id=$(this).attr("data-id");
				var price=parseFloat($("#price"+product_id).html());
				var subtotal=parseFloat($("#total"+product_id).html());
				var qty=$(this).val();
				var total=price*qty;
				$("#total"+product_id).html(total.toFixed(2));
				var all_total =parseFloat($(".all_total").html())-subtotal+total;
				$(".all_total").html(all_total.toFixed(2));
				$.ajax({
					type: 'GET',
					url: "ajax/change_qty.php?product_id="+product_id+"&qty="+qty,
				});
			});
			$('.my-product-remove').on('click', function(c){
				var product_id=$(this).attr("data-id");
				var subtotal=parseFloat($("#total"+product_id).html());
				var all_total =parseFloat($(".all_total").html())-subtotal;
				$.ajax({
					type: 'GET',
					url: "ajax/delete_product.php?product_id="+product_id,
					success: function(returnData){
						$("#cart-table"+product_id).fadeOut('slow', function(c){
							$(".all_total").html(all_total.toFixed(2));
							$("#cart-table"+product_id).hide();
							if(returnData!=''){
								$("#catr_body").html(returnData);
							}

						});
					}
				});
			});
		});
	</script> 