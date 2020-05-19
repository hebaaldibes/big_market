<?php require ("../includes/connection.php");?>
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
header("location:login.php");
}
else {
$query ="SELECT * FROM admin where id={$_SESSION['admin_id']}";
$result= mysqli_query($conn,$query);
$adminSet= mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title>Admin Dashboard</title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Menu CSS -->
<link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
<!-- animation CSS -->
<!--     <link href="css/animate.css" rel="stylesheet">
-->    <!-- Custom CSS -->
<link href="../css/style.css" rel="stylesheet">
<style type="text/css">
input[type=number]::-webkit-inner-spin-button {
-webkit-appearance: none;
}
</style>
<!-- color CSS -->
<link href="../css/colors/default.css" id="theme" rel="stylesheet">
<link href="../css/custom.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
<svg class="circular" viewBox="25 25 50 50">
<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
</svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<nav class="navbar navbar-default navbar-static-top m-b-0">
<div class="navbar-header">
<div class="top-left-part">
<!-- Logo -->
<a class="logo" href="dashboard.html">
<!-- Logo icon image, you can use font-icon also --><b>
    <!--This is dark logo icon--><img src="../plugins/images/admin-logo.png" alt="home"
    class="dark-logo" />
    <!--This is light logo icon--><img src="../plugins/images/admin-logo-dark.png" alt="home"
    class="light-logo" />
</b>
<!-- Logo text image you can use text also --><span class="hidden-xs">
    <!--This is dark logo text--><img src="../plugins/images/admin-text.png" alt="home"
    class="dark-logo" />
    <!--This is light logo text--><img src="../plugins/images/admin-text-dark.png" alt="home"
    class="light-logo" />
</span> </a>
</div>
<!-- /Logo -->
<ul class="nav navbar-top-links navbar-right pull-right">
<li>
    <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg"
    href="javascript:void(0)"><i class="fa fa-bars"></i></a>
</li>
<li>
    <a class="profile-pic" href="profile.php"><img src="../plugins/images/users/admin/<?php echo $adminSet['image'];?>" alt="user-img"
        width="36" class="img-circle"><b class="hidden-xs"><?php echo $adminSet['admin_name'];?></b></a>
    </li>
    <li>
        <a class="profile-pic" href="logout.php" class="btn btn-secondary"><b class="hidden-xs">Logout</b></a>
    </li>
</ul>
</div>
<!-- /.navbar-header -->
<!-- /.navbar-top-links -->
<!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
<div class="sidebar-nav slimscrollsidebar">
<div class="sidebar-head">
    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
        class="hide-menu">Navigation</span></h3>
    </div>
    <ul class="nav" id="side-menu">
        <li style="padding: 70px 0 0;">
            <a href="index.php" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                aria-hidden="true"></i>Dashboard</a>
            </li>
            <li>
                <a href="profile.php" class="waves-effect"><i class="fa fa-user fa-fw"
                    aria-hidden="true"></i>Profile</a>
                </li>
                <li>
                    <a href="manage_admin.php" class="waves-effect"><i class="fa fa-briefcase fa-fw"
                        aria-hidden="true"></i>Manage Admin</a>
                    </li>
                    <li>
                        <a href="manage_market.php" class="waves-effect"><i class="fa fa-bank fa-fw"
                            aria-hidden="true"></i>Manage Market</a>
                        </li>
                            <li>
                                <a href="manage_category.php" class="waves-effect"><i class="fa  fa-list fa-fw"
                                    aria-hidden="true"></i>Manage Category</a>
                                </li>
                                <li>
                                    <a href="manage_subcategory.php" class="waves-effect"><i class="fa fa-sitemap fa-fw"
                                        aria-hidden="true"></i>Manage SubCategory</a>
                                    </li>
                                    <li>
                                        <a href="manage_product.php" class="waves-effect"><i class="fa  fa-asterisk fa-fw"
                                            aria-hidden="true"></i>Manage Product</a>
                                        </li>
                                        <li>
                                            <a href="manage_customer.php" class="waves-effect"><i class="fa  fa-group fa-fw"
                                                aria-hidden="true"></i>Manage Customer</a>
                                            </li>
                                            <li>
                                                <a href="manage_customer_order.php" class="waves-effect"><i class="fa fa fa fa-shopping-basket fa-fw"
                                                    aria-hidden="true"></i>Manage Customer Order</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- End Left Sidebar -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- Page Content -->
                                    <!-- ============================================================== -->
                                    <div id="page-wrapper">
                                        <div class="container-fluid">
                                            <div class="row bg-title">
                                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                                    <h4 class="page-title">Dashboard</h4> </div>
                                                    <!-- /.col-lg-12 -->
                                                </div>
                                                <!-- /.row -->
                                                <!-- ============================================================== -->
                                                <!-- Different data widgets -->
                                                <!-- ============================================================== -->
<!-- .row -->