<?php
	session_start();
	error_reporting(0);
	if(!isset($_SESSION['IsLoggedIn'])){
		$_SESSION['warning1']="true";
		header("location:index.php");
	}
	include "conn.php";

	$site_title = "eAuction";
	function findDate()
	{
		$timezone = date_default_timezone_get();
		date_default_timezone_set($timezone);
		$date = date('Y-m-d h:i:s', time());
		return $date;
	}
	function js_alert($x)
	{
		// echo "<script>alert('$x');</script>";
		?>
		<script>
			alert("<?php echo $x; ?>");
		</script>
		<?php
	}
	function js($js)
	{
		?>
		<script>
			<?php echo $js; ?>
		</script>
		<?php
	}
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#4188c9">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="icon" href="./favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
	<!-- Generated: 2018-04-16 09:29:05 +0200 -->
	<title>eAuction - Auction | online</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	<script src="./assets/js/require.min.js"></script>
	<script src="./assets/js/jquery-3.3.1.min.js"></script>
	<script>
		requirejs.config({
			baseUrl: '.'
		});
	</script>
	<!-- Dashboard Core -->
	<link href="./assets/css/dashboard.css" rel="stylesheet" />
	<script src="./assets/js/dashboard.js"></script>
	<!-- c3.js Charts Plugin -->
	<link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
	<script src="./assets/plugins/charts-c3/plugin.js"></script>
	<!-- Google Maps Plugin -->
	<link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
	<script src="./assets/plugins/maps-google/plugin.js"></script>
	<!-- Input Mask Plugin -->
	<script src="./assets/plugins/input-mask/plugin.js"></script>
	<style>
		input:disabled {
			background: transparent !important;
			border: unset;
		}

		.len_max:focus {
			color: #495057;
			background-color: #fff;
			border-color: rgb(255, 0, 0);
			outline: 0;
			box-shadow: 0 0 0 2px rgba(255, 0, 0, 0.25);
		}
	</style>
</head>

<body class="">
	<div class="page">
		<div class="page-main">
			<div class="header py-4">
				<div class="container">
					<div class="d-flex">
						<a class="header-brand" href="./index.html">
							<?php echo $site_title; ?>
						</a>
						<div class="d-flex order-lg-2 ml-auto">
							<div class="dropdown d-none d-md-flex">
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<a href="#" class="dropdown-item d-flex">
										<span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
										<div>
											<strong>Nathan</strong> pushed new commit: Fix page load performance issue.
											<div class="small text-muted">10 minutes ago</div>
										</div>
									</a>
									<a href="#" class="dropdown-item d-flex">
										<span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
										<div>
											<strong>Alice</strong> started new task: Tabler UI design.
											<div class="small text-muted">1 hour ago</div>
										</div>
									</a>
									<a href="#" class="dropdown-item d-flex">
										<span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
										<div>
											<strong>Rose</strong> deployed new version of NodeJS REST Api V3
											<div class="small text-muted">2 hours ago</div>
										</div>
									</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
								</div>
							</div>
							<div class="dropdown">
								<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
									<!-- <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span> -->
									<span class="ml-2 d-none d-lg-block">
										<span class="text-default"><?php echo $_SESSION['uname']; ?></span>
										<small class="text-muted d-block mt-1"><?php echo $_SESSION['ut_name']; ?></small>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<a class="dropdown-item" href="#">
										<i class="dropdown-icon fe fe-user"></i> Profile
									</a>
									<!-- <a class="dropdown-item" href="#">
										<i class="dropdown-icon fe fe-settings"></i> Settings
									</a>
									<a class="dropdown-item" href="#">
										<span class="float-right"><span class="badge badge-primary">6</span></span>
										<i class="dropdown-icon fe fe-mail"></i> Inbox
									</a>
									<a class="dropdown-item" href="#">
										<i class="dropdown-icon fe fe-send"></i> Message
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">
										<i class="dropdown-icon fe fe-help-circle"></i> Need help?
									</a> -->
									<a class="dropdown-item" href="logout.php">
										<i class="dropdown-icon fe fe-log-out"></i> Sign out
									</a>
								</div>
							</div>
						</div>
						<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
							<span class="header-toggler-icon"></span>
						</a>
					</div>
				</div>
			</div>
			<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
				<div class="container">
					<div class="row align-items-center">
						<?php
							$utype=$_SESSION['utype'];
							if($utype=="a"){
								$menu_items = "<div class='col-lg order-lg-first'>";
								$menu_items = $menu_items . "<ul class='nav nav-tabs border-0 flex-column flex-lg-row'>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='manage_category.php' class='nav-link' >Categories</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='manage_product.php' class='nav-link' >Products</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='manage_customer.php' class='nav-link' >Customers</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='manage_vendor.php' class='nav-link' >Vendors</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='manage_bids.php' class='nav-link' >Complete Bid</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='bid_result.php' class='nav-link' >Bid Result</a></li>";
								$menu_items = $menu_items . "</ul></div>";

								echo $menu_items;
							}
							else if($utype=="c"){
								$menu_items = "<div class='col-lg order-lg-first'>";
								$menu_items = $menu_items . "<ul class='nav nav-tabs border-0 flex-column flex-lg-row'>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='bid_do.php' class='nav-link' >Start Bid</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='bid_result.php' class='nav-link' >Bid Result</a></li>";
								$menu_items = $menu_items . "</ul></div>";
								echo $menu_items;
							}
							else if($utype=="v"){
								$menu_items = "<div class='col-lg order-lg-first'>";
								$menu_items = $menu_items . "<ul class='nav nav-tabs border-0 flex-column flex-lg-row'>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='category.php' class='nav-link' >Category</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='product.php' class='nav-link' >Product</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='bid_result.php' class='nav-link' >Bid Results</a></li>";
								$menu_items = $menu_items . "<li class='nav-item'><a href='bids_open.php' class='nav-link' >Schedule Bid</a></li>";
								$menu_items = $menu_items . "</ul></div>";
								echo $menu_items;
							}
						?>
						<!-- <div class="col-lg order-lg-first">
							<ul class="nav nav-tabs border-0 flex-column flex-lg-row">
								<li class="nav-item">
									<a href="./index.html" class="nav-link"><i class="fe fe-home"></i> Home</a>
								</li>
								<li class="nav-item">
									<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Interface</a>
									<div class="dropdown-menu dropdown-menu-arrow">
										<a href="./cards.html" class="dropdown-item ">Cards design</a>
										<a href="./charts.html" class="dropdown-item ">Charts</a>
										<a href="./pricing-cards.html" class="dropdown-item ">Pricing cards</a>
									</div>
								</li>
								<li class="nav-item dropdown">
									<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Components</a>
									<div class="dropdown-menu dropdown-menu-arrow">
										<a href="./maps.html" class="dropdown-item ">Maps</a>
										<a href="./icons.html" class="dropdown-item ">Icons</a>
										<a href="./store.html" class="dropdown-item ">Store</a>
										<a href="./blog.html" class="dropdown-item ">Blog</a>
										<a href="./carousel.html" class="dropdown-item ">Carousel</a>
									</div>
								</li>
								<li class="nav-item dropdown">
									<a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i> Pages</a>
									<div class="dropdown-menu dropdown-menu-arrow">
										<a href="./profile.html" class="dropdown-item ">Profile</a>
										<a href="./login.html" class="dropdown-item ">Login</a>
										<a href="./register.html" class="dropdown-item ">Register</a>
										<a href="./forgot-password.html" class="dropdown-item ">Forgot password</a>
										<a href="./400.html" class="dropdown-item ">400 error</a>
										<a href="./401.html" class="dropdown-item ">401 error</a>
										<a href="./403.html" class="dropdown-item ">403 error</a>
										<a href="./404.html" class="dropdown-item ">404 error</a>
										<a href="./500.html" class="dropdown-item ">500 error</a>
										<a href="./503.html" class="dropdown-item ">503 error</a>
										<a href="./email.html" class="dropdown-item ">Email</a>
										<a href="./empty.html" class="dropdown-item ">Empty page</a>
										<a href="./rtl.html" class="dropdown-item ">RTL mode</a>
									</div>
								</li>
								<li class="nav-item dropdown">
									<a href="./form-elements.html" class="nav-link active"><i class="fe fe-check-square"></i> Forms</a>
								</li>
								<li class="nav-item">
									<a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
								</li>
								<li class="nav-item">
									<a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
								</li>
							</ul>
						</div> -->
					</div>
				</div>
			</div> 