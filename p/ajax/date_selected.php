<?php
require ("../includes/connection.php");
if($_GET['date_selected']){
	$count=0;
	$month=$_GET['date_selected'];


	if(isset($_GET['market_id'])){
		$market=$_GET['market_id'];
	$query = "SELECT product.id,product_name,product_img,product_price,market_name
    FROM product 
	INNER JOIN customer_order ON customer_order.product_id = product.id 
	INNER JOIN market ON market.id = product.market_id 
	WHERE  product.market_id = $market AND customer_order.order_date BETWEEN '2020-$month-1 00:00:00' AND '2020-$month-31 23:59:59'
	GROUP BY product.id
	LIMIT 10";
	}
	else{
	$query = "SELECT product.id,product_name,product_img,product_price,market_name
    FROM product 
	INNER JOIN customer_order ON customer_order.product_id = product.id 
	INNER JOIN market ON market.id = product.market_id 
	WHERE customer_order.order_date BETWEEN '2020-$month-1 00:00:00' AND '2020-$month-31 23:59:59'  GROUP BY product.id
	LIMIT 10";
	}

	$result= mysqli_query($conn,$query);
	while ($product= mysqli_fetch_assoc($result)){
		$qty=0;
		$count=$count+1;
		$query_qty = "SELECT quantity FROM customer_order WHERE product_id={$product['id']}";
		$result2= mysqli_query($conn,$query_qty);
		while ($qty_pro= mysqli_fetch_assoc($result2)){
		$qty=$qty+$qty_pro['quantity'];
	}
		echo "<tr>
		<td>$count</td>
		<td class='txt-oflo'>{$product['product_name']}</td>
		<td class='txt-oflo'><img src='../plugins/images/product/{$product['product_img']}' width='50px'></td>
		<td class='txt-oflo'>{$product['market_name']}</td>
		<td class='txt-oflo'>$<span>{$product['product_price']}</span></td>
		<td><span class='text-success'>$qty</span></td>
		</tr>";

	}
}
?>