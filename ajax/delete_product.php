<?php
session_start();
$product_id= $_GET['product_id'];
unset($_SESSION["product"][$product_id]);
unset($_SESSION["qty"][$product_id]);
if(count($_SESSION["product"])==0){
	echo "<h3 class='text-center'>The Cart is Empty!</h3>";
}
?>