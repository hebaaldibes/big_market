<?php 
require ("../includes/connection.php");
	$sub_cat="";
if (isset($_GET['id'])){
	$query = "SELECT * FROM subcategory WHERE cat_id='{$_GET['id']}' ORDER BY subCatName";
	$result= mysqli_query($conn,$query);
	while ($row = mysqli_fetch_assoc($result)){
	   $sub_cat = $sub_cat ."<option value='{$row['id']}' data-id='{$row['id']}'>
	   {$row['subCatName']}</option>";
}
}
echo $sub_cat;
?>