<?php
	session_start();
	include("conn.php");
	$site_title="eAuction";
	if(isset($_SESSION['warning1'])){
		if($_SESSION['warning1']=="true"){
			echo "<script>alert('Please login to continue!');</script>";
		}
		$_SESSION['warning1']=null;
	}
	// print_r($_REQUEST);
	if(isset($_REQUEST['login'])){
		$email=$_REQUEST['email'];
		$pass=$_REQUEST['pass'];

		if($email=="admin@gmail.com" && $pass=="admin"){
			$_SESSION['IsLoggedIn']="true";
			$_SESSION['utype']="a";
			$_SESSION['ut_name']="<b>Administrator</b>";
			$_SESSION['uid']=9999;
			$_SESSION['uname']="Pathik Patel";
			header("location:manage_customer.php");
		}
		$q1="select * from customer where email='$email' && pass='$pass'";
		$e1=$conn->query($q1);
		// print_r($e1);
		if($e1->num_rows > 0){
			$data1=$e1->fetch_object();
			$sc=$data1->status;
			// echo $sc;
			if($sc == -1){
				echo "<script>alert('Your profile is not verified yet,Try again after some time!');</script>";
			}
			else if($sc == 0){
				echo "<script>alert('Sorry, Your profile is Rejected / Blocked!');</script>";
				// echo "0";
			}
			else if($sc == 1){
				$_SESSION['IsLoggedIn']="true";
				$_SESSION['utype']="c";
				$_SESSION['ut_name']="Customer";
				$_SESSION['uid']=$data1->cu_id;
				$_SESSION['uname']=$data1->fname . " " . $data1->lname;
				header("location:bids_open.php");
			}
		}
		else{
			$q2="select * from vendor where email='$email' && pass='$pass'";
			$e2=$conn->query($q2);
			if($e2->num_rows > 0){
				$data2=$e2->fetch_object();
				if($data2->status == "-1"){
					echo "<script>alert('Your profile is not verified yet,Try again after some time!');</script>";
				}
				else if($data2->status == "0"){
					echo "<script>alert('Sorry, Your profile is Rejected / Blocked!');</script>";
				}
				else if($data2->status == "1"){
					$_SESSION['IsLoggedIn']="true";
					$_SESSION['utype']="v";
					$_SESSION['ut_name']="Vendor";
					$_SESSION['uid']=$data2->ve_id;
					$_SESSION['uname']=$data2->fname . " " . $data2->lname;
					header("location:product.php");
				}
			}
		}
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
<style>
	/**/
	.header {
		visibility: hidden;
	}
	@media (min-width: 1280px){
		.container{
			margin-top: 20px;
		}
	}
</style>

<!-- <body class=""> -->
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
								<div class="card-title">Login to your account</div>
								<div class="form-group">
									<label class="form-label">Email address</label>
									<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
								</div>
								<div class="form-group">
									<label class="form-label">
										Password
										<!-- <a href="./forgot-password.html" class="float-right small">I forgot password</a> -->
									</label>
									<input type="password" class="form-control" name="pass" placeholder="Password" required>
								</div>
								<div class="form-group">
									<label class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" />
										<span class="custom-control-label">Remember me</span>
									</label>
								</div>
								<div class="form-footer">
									<button type="submit" value="login" name="login" class="btn btn-primary btn-block">Sign in</button>
								</div>
							</div>
						</form>
						<div class="text-center text-muted">
							Don't have account yet? <a href="register.php">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- </body> -->