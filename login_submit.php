<?php
// Kết nối đến cơ sở dữ liệu
	include 'config.php';

	if(isset($_POST['submit'])) {
		// Lấy dữ liệu từ form đăng ký
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		// Kiểm tra xem tên đăng nhập and email đã tồn tại trong cơ sở dữ liệu chưa
		$sql = "SELECT * FROM taikhoan WHERE TenTK='$username'";
		$result = mysqli_query($conn, $sql);
		$check_user = mysqli_num_rows($result);
		$data = mysqli_fetch_assoc($result); //giải mã dữ liệu lấy từ database
		if($check_user > 0) {
			$sql2 = "SELECT * FROM taikhoan WHERE MatKhau='$password'";
			$result2 = mysqli_query($conn, $sql2);
			$check_pass = mysqli_num_rows($result2);
			if($check_pass) {
				//lưu vào session
				$_SESSION['id'] = $data['ID'];
				$_SESSION['user'] = $data;
				$_SESSION['login_user'] = $username;
				$_SESSION['login_pass'] = $data['MatKhau'];
				$_SESSION['quyen'] = $data['Quyen'];
				$_SESSION['email'] = $data['Email'];
				$quyen = $data['Quyen'];
			
				if($quyen == '0')
					header('location: sanbong.php');
				if($quyen == '1')
					header('location: home.php'); 				
			}
			else {
				echo "<script>
					alert('Sai mật khẩu!');
					window.history.back();
					</script>";
			}
		} 
		else {
			echo "<script>
				alert('Tên đăng nhập không tồn tại!');
				window.history.back();
				</script>";
		}
	mysqli_close($conn);
	}
?>