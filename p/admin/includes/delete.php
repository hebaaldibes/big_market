<?php
require ("../includes/connection.php");
if($_GET['table_name']=="customer_order"){
$query="delete from customer_order where order_id={$_GET['row_id']}";	
}
else {
	$query="delete from {$_GET['table_name']} where id={$_GET['row_id']}";
}

mysqli_query($conn,$query);
echo $_GET['row_id'];
?>