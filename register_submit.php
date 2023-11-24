<?php
	//kết nối với csdl
	include 'config.php';
	if(isset($_POST['submit'])) {
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$sdt = $_POST['sdt'];
		$password = $_POST['password'];
		$rpassword = $_POST['rpassword'];
		
		$check = "select * from taikhoan where Email = '$email' or TenTk = '$username'";
		$result_check = mysqli_query($conn, $check);
		
		if(mysqli_num_rows($result_check) > 0) {
			echo "<script>
						alert('Email hoặc tên đăng nhập đã tồn tại!');
						window.history.back();
						</script>";
		}
		else 
			if($password === $rpassword) {
			    $sql = "INSERT INTO taikhoan(TenTK, MatKhau, Email,Quyen) VALUES ('$username', '$password', '$email',0) ";
				$query = mysqli_query($conn, $sql);
				$sql1 = "INSERT INTO khachhang (TenKH, Email, SoDT) VALUES ('$fullname', '$email', '$sdt') ";
				$result = mysqli_query($conn, $sql1);
				if($query) {
					echo "<script>
							alert('Đăng ký thành công!');
							window.location.href = 'login.php';
							</script>";
					$sql_kh = "INSERT INTO khachhang(Email) VALUES ('$email') ";
					$query_kh = mysqli_query($conn, $sql_kh);
				}
				else {
					echo "<script>
							alert('Lỗi đăng kí!');
							window.history.back();
							</script>";
				}
			}
			else {
				echo "<script>
						alert('Mật khẩu nhập lại không đúng!');
						window.history.back();
						</script>";
			}
		mysqli_close($conn);
	}
?>