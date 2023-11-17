<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8">
	<title>Đăng Nhập - TPT</title>
	<link rel="icon" type="image/x-icon" href="img/logo.ico">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.login * {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body {
			font-family: 'Poppins', sans-serif;
		}

		.login {
			width: 500px;
			background: #f1f1f1;
			margin: 100px auto;
			padding: 20px 30px;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px rgba(248, 247, 247, 0.3);
		}

		.login h1 {
			text-align: center;
			margin-bottom: 30px;
		}

		.login form {
			display: flex;
			flex-direction: column;
		}

		#password , #username {
			font-size: 18px;
			color: #555;
			margin-bottom: 10px;
			display: flex;
			align-items: center;
		}
		.login form input[type="text"], .login form input[type="password"] {
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			background: #f9f9f9;
		}
		.login form input[type="submit"] {
			background: #003300;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px;
			font-size: 18px;
			cursor: pointer;
		}
		.reg {
			color: #003300;
			margin: auto;
			text-decoration: none;
		}
		.reg:hover {
			text-decoration: underline;
		}
		.hd {
			padding: 0;
			margin-top: 0;
		}
	</style>
</head>
<body>
	<?php //include 'header-2.php'?>
	<div class="body-intro">
	<div class="login" style="width: 400px!important;">
		<h1 style="color: #003300;">Đăng nhập</h1>
		<form action="login_submit.php" method="post">
		
			<label id="username">Tên đăng nhập</label>
			<input type="text" name="username" required >

			<label id="password">Mật khẩu</label>
			<input type="password" name="password" required>
			<br><input type="submit" name="submit" value="Đăng nhập">

			<br><a href="register.php" class="reg">Chưa có tài khoản? Đăng ký</a>
			<br><a href="sanbong.php" class="reg">Thoát</a>           
		</form>
	</div>
	</div>
</body>
</html>
