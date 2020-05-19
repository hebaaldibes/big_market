<?php
require ("../includes/connection.php");
if($_GET['table_name']=="admin"){
	if ($_POST['full_name']!="" && $_POST['email']!="" && $_POST['password']!="") {
		$name=$_POST['full_name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$query= "update admin set admin_name='$name', 
		email='$email', 
		password ='$password'
		where id={$_GET['row_id']}";
		mysqli_query($conn,$query);
	}
	else {
		echo "false";
	}
}
else if ($_GET['table_name']=="category") {
        if ($_POST['category_name']!="") {
        $name=$_POST['category_name'];
        $query= "update category set cat_name='$name'
		where id={$_GET['row_id']}";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}
else if($_GET['table_name']=="subcategory"){
	 if ($_POST['sub_cat_name']!="" && isset($_POST['category_name'])) {
		$sub_cat_name=$_POST['sub_cat_name'];
        $category_id=$_POST['category_name'];

		$query= "update subcategory set  
		subCatName='$sub_cat_name', 
		cat_id = $category_id
		where id={$_GET['row_id']}";
		mysqli_query($conn,$query);
	}
	else {
		echo "false";
	}
}
else if($_GET['table_name']=="customer"){
	 if ($_POST['full_name']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['phone']!="" && $_POST['address']!="") {
		$name=$_POST['full_name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];

		$query= "update customer set customer_name='$name', 
		email='$email', 
		password ='$password',
		phone = $phone, 
		address = '$address'
		where id={$_GET['row_id']}";
		mysqli_query($conn,$query);
	}
	else {
		echo "false";
	}
}
else if ($_GET['table_name']=="market") {
        if ($_POST['market_name']!="") {
        $name=$_POST['market_name'];
        $query= "update market set market_name='$name'
		where id={$_GET['row_id']}";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}
else if($_GET['table_name']=="employer"){
	 if ($_POST['full_name']!="" && $_POST['email']!="" && $_POST['password']!="" && isset($_POST['market_name'])) {
		$name=$_POST['full_name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $market_id=$_POST['market_name'];

		$query= "update employer set employer_name='$name', 
		email='$email', 
		password ='$password',
		market_id = $market_id
		where id={$_GET['row_id']}";
		mysqli_query($conn,$query);
	}
	else {
		echo "false";
	}
}
?>