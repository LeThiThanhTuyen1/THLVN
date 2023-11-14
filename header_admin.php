<?php
	@session_start();
	include 'config.php';
	$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
?>

<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
	<style>
		body {
			margin-top: 0;
			margin-left: 0;
			position: relative;
		}
		.container * {
			padding: 0;
			margin: 0;
		}
		.container nav {
			background-color: #003300;
			height: 50px!important;
			width: 100%;
			position: fixed;
			padding: 0;
			display: inline-block;
		}
		.container nav:before {
			display: table;
			content: "";
		}
		.container {
			margin: 0 auto;
		}
		.main-menu li a img {
			width: 30px;
			height: 50px;
			padding-top: 5px;
		}
		.main-menu > li {
			float: right;
			line-height: 50px;
			list-style: none;
			position: relative;
		}
		ul.main-menu > li > a, nav .sign-in  a {
			color: #fff;
			font-size: 20px;
			text-decoration: none;
			display: block;
			padding: 0px 10px 0 10px;
		}
		nav .sign-in {
			float: right;
		}
		ul.sub-menu li a {
			color: white;
			text-decoration: none;
			display: block;
			border-top: 1px solid #ccc;
			line-height: 50px;
			text-indent: 10px;
			font-size: 20px;
			padding-left: 0px;
		}
		ul.sub-menu li {
			list-style: none;
		}
		ul.sub-menu {
			min-height: 80px;
			background-color: #003300;
			width: 180px;
			position: absolute;
			display: none;
		}
		.click-menu {
			cursor: pointer;
			line-height: 50px;
			padding-top: 10px;
			width: 90px;
		}
		.hover {
			display: block;
			color: #525252;
		}
		.sub-menu ul li a:hover {
			font-weight: 600;
		}
		ul.main-menu > li > a.hover:hover, ul.sub-menu li a:hover, .click-menu:hover{
			transition: ease-out 0.35s;
			-moz-transition: ease-out0.35s;
			-webkit-transition: ease-out 0.35s;
			color: #ffffff;
			background: #CC6600;
			font-size: 20px;
			text-decoration: none;
		} 
		ul.main-menu > li:hover ul.sub-menu {
			display: block;
		}
		.hover i {
			margin-left: -5px!important;
		}
	</style>
</head>
<body>
	<div class="container">
		<nav>
			
			<div>
				<ul class='main-menu' style='float: left!important'>
					<a href="home.php"><img style='padding: 10px 0 0 10px; height: 30px; width: 30px;' src="img/logo.png" alt="Logo"></a>
					<li><a href="home.php">Sân bóng TTVHO</a></li>
				</ul>
			</div>
			
			<div id="menu">
				<ul class="main-menu">
				<div class="sign-in">
				<?php if(isset($user['TenTK'])) { ?>
					<div class="drop-menu">
						<ul class="main-menu">
							<li>
								<a class="click-menu" href="#" ><?php echo $user['TenTK'] ?> </a>
								<ul class="sub-menu">
									<li><a class="hover" href="thongke.php"> Thống kê</a></li>
									<li><a class="hover" href="logout.php"> Thoát</a></li>
								</ul>
							</li>
						</ul>
					</div>
				<?php 
				} else { ?>
					<div class="drop-menu">
						<ul class="main-menu">
							<li><a href="#" class="click-menu">Tài khoản</a>
								<ul class="sub-menu"> 
									<li><a href="login.php" class="hover"> Đăng nhập</a></li>
									<li><a href="register.php" class="hover"> Đăng ký</a></li>
								</ul>
							</li>
						</ul>
					</div>
				<?php } ?>
			</div>	
					<li><a class="hover" href="status_admin.php">Trạng thái</a></li>
					<li><a class="hover" href="khachhang_admin.php">Khách hàng</a></li>
					<li><a class="hover" href="sanbong_admin.php">Sân bóng</a></li>	
					<li><a class="hover" href="home.php">Trang chủ</a></li>					
			</div>
					
		</nav>
	</div>
</body>
</html>