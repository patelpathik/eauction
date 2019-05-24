<?php
	session_start();
	$site_title="eAuction";
	include "conn.php";
	//error_reporting(0);
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
<style>
	/**/
	.header {
		visibility: hidden;
	}
	@media (min-width: 1280px){
		.container{
			/* margin-top: 10px; */
		}
	}
</style>
<?php
	if(isset($_REQUEST['signup'])){
		$fname=$_REQUEST['fname'];
		$lname=$_REQUEST['lname'];
		$email=$_REQUEST['email'];
		$pass=$_REQUEST['pass'];
		$utype=$_REQUEST['utype'];

		$qc1="select * from customer where email='$email'";
		$ec1=$conn->query($qc1);

		$qc2="select * from vendor where email='$email'";
		$ec2=$conn->query($qc2);

		if($ec1->num_rows > 0 || $ec2->num_rows > 0){
			echo "<script>alert('\'$email\' already exists!!');</script>";
		}
		else{
			$q1="insert into $utype (fname,lname,email,pass) values ('$fname','$lname','$email','$pass')";
			$e1=$conn->query($q1);
			echo "<script>window.top.location='index.php';</script>";
		}
	}
?>
<body class="">
	<div class="page">
		<div class="page-single">
			<div class="container">
				<div class="row">
					<div class="col col-login mx-auto">
						<div class="text-center mb-6">
							<h3><?php echo $site_title; ?></h3>
						</div>
						<form class="card" action="" method="post">
							<div class="card-body p-6">
								<div class="card-title">Create new account</div>
								<div class="form-group">
									<label class="form-label">First Name</label>
									<input type="text" class="form-control" name="fname" placeholder="Patrick" required>
								</div>
								<div class="form-group">
									<label class="form-label">Last Name</label>
									<input type="text" class="form-control" name="lname" placeholder="Patel" required>
								</div>
								<div class="form-group">
									<label class="form-label">Email address</label>
									<input type="email" class="form-control" name="email" placeholder="patrick@work.com" required>
								</div>
								<div class="form-group">
									<label class="form-label">Password</label>
									<input type="password" class="form-control" name="pass" placeholder="Password" required>
								</div>
								<div class="form-group">
									<label class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" name="utype" value="customer" checked required>
									<span class="custom-control-label">Customer</span>
									&nbsp;&nbsp;&nbsp;
									<label class="custom-control custom-radio custom-control-inline">
									<input type="radio" class="custom-control-input" name="utype" value="vendor">
									<span class="custom-control-label">Vendor</span>
									</label>
								</div>
								<div class="form-group">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" checked required />
										<span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
									</label>
								</div>
								<div class="form-footer">
									<button type="submit" name="signup" class="btn btn-primary btn-block">Create new account</button>
								</div>
							</div>
						</form>
						<div class="text-center text-muted">
							Already have account? <a href="index.php">Sign in</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body> 