<?php
session_start();
$product_id= $_GET['product_id'];
$qty= $_GET['qty'];
$_SESSION["qty"][$product_id]=$qty;
echo $_SESSION["qty"][$product_id];
?>