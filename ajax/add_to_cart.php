<?php
session_start();
    //add current product to inside session
	$productID=$_GET['product_id'];

	if(isset($_SESSION["product"][$productID])){
		$_SESSION["qty"][$productID]=$_SESSION["qty"][$productID]+1;
	}
	$_SESSION["product"][$productID]= $productID;	
?>