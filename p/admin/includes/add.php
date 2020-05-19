<?php

require ("../includes/connection.php");
//header("Content-Type: Application/json");
if($_GET['table_name']=="admin"){
	if ($_POST['full_name']!="" && $_POST['email']!="" && $_POST['password']!="") {
		$name=$_POST['full_name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$query= "insert into admin(admin_name, email, password)
        VALUES ('$name', '$email', '$password')";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}
elseif ($_GET['table_name']=="category") {
        if ($_POST['category_name']!="") {
        $name=$_POST['category_name'];
        $query= "insert into category(cat_name)
        VALUES ('$name')";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}
elseif($_GET['table_name']=="subcategory"){
    if ($_POST['sub_cat_name']!="" && isset($_POST['category_name'])) {
        $sub_cat_name=$_POST['sub_cat_name'];
        $category_id=$_POST['category_name'];
        $query= "insert into subcategory(subCatName, cat_id)
        VALUES ('$sub_cat_name', $category_id)";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}
elseif($_GET['table_name']=="customer"){
    if ($_POST['full_name']!="" && $_POST['email']!="" && $_POST['password']!="" && $_POST['phone']!="" && $_POST['address']!="") {
        $name=$_POST['full_name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
        $query= "insert into customer(customer_name, email, password, phone, address)
        VALUES ('$name', '$email', '$password', $phone, '$address')";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}
elseif($_GET['table_name']=="employer"){
    if ($_POST['full_name']!="" && $_POST['email']!="" && $_POST['password']!="" && isset($_POST['market_name'])) {
        $name=$_POST['full_name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $market_id=$_POST['market_name'];
        $query= "insert into employer(employer_name, email, password, market_id)
        VALUES ('$name', '$email', '$password', $market_id)";
        mysqli_query($conn,$query);
    }
    else {
        echo "false";
    }
}

?>