<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Đăng ký tài khoản</title>
	<link rel="icon" type="image/x-icon" href="img/logo.ico">
</head>
<style>
	body {
	/*background: rgba(0,0,0,0);*/
	line-height: 1.3;
	font-size: 18px;
	font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif;
}
	* { 
    margin: 0;
    padding: 0;
    box-sizing: border-box;
} 
	.log {
	width: 450px;
	background: #f1f1f1;
	color: #555;
	margin: 100px auto;
	padding: 20px 30px;
	border-radius: 5px;
	box-shadow: 0px 0px 5px 0px rgba(248, 247, 247, 0.3);
}
.log h1 {
	text-align: center;
	margin-bottom: 30px;
}
.log form {
	display: flex;
	flex-direction: column;
}
.log .signup-label {
	font-size: 17px;
	margin-bottom: 10px;
	display: flex;
	align-items: center;
}
.log .signup-input {
	padding: 10px;
	margin-bottom: 20px;
	border-radius: 5px;
	border: none;
	background: #f9f9f9;
}
.log .signup-in {
	font-size: 17px;
	text-align: center;
	color: #003300;
	text-decoration: none;
}
.log .signup-in:hover {
	text-decoration: underline;
}
.log .signup-sm {
	background: #003300;
	border: none;
	color: white;
	border-radius: 5px;
	padding: 10px;
	font-size: 17px;
	cursor: pointer;
}
	</style>
<body>
	<div class="log">
		<form action="register_submit.php" method="POST">
			<h1 style="color: #003300;">Đăng ký</h1>
			<label class="signup-label">Tên tài khoản:</label>
			<input class="signup-input" type="text" name="username" required>
			
			
			<label class="signup-label">Email:</label>
			<input class="signup-input" type="email" name="email" required>
			

			<label class="signup-label">Mật khẩu:</label>
			<input class="signup-input" type="password" name="password" required>
			
			
			<label class="signup-label">Nhập lại mật khẩu:</label>
			<input class="signup-input" type="password" name="rpassword" required>
			

			<input class="signup-sm" type="submit" name="submit" value= "Đăng ký tài khoản">
			<br><a href="login.php" class="signup-in">Đã có tài khoản? Đăng nhập</a>
		</form>
			
	</div>
</body>
</html>
