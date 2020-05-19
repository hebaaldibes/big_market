<?php 
require ("../includes/connection.php");
	$user_id=0;
if (isset($_GET['email'])){
	$query = "SELECT id FROM {$_GET['table_name']} WHERE email='{$_GET['email']}'";
	$result= mysqli_query($conn,$query);
	while ($row = mysqli_fetch_assoc($result)){
	 $user_id=$row['id'];
}
}
echo $user_id;
?>