<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng TTVHO</title>
    <style>
        body {
            background-color: #125c0b;
        }
        .sanbong-div {
            margin-left: 50px;
        }
        .status-div {
            margin: 12.5%;
            margin-top: 100px;
            padding: 10px 40px 40px;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
        }
        h1 {
            text-align: center;
        }
        label {
            margin-left: 35%;
            font-size: 18px;
            line-height: 40px;
        }
        input {
            font-size: 16px;
            margin-left: 5px;
        }
        .sm {
            margin-left: 45%;
            color: red;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header.php';

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM taikhoan";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
    echo '<div class="status-div">
        <h1>ĐỔI MẬT KHẨU</h1>
        <form action="" method="POST">
            <label class="label">Tên tài khoản:</label>
            <input style="background-color: #FFE4B5; width: 272px;"  value=" '. $_SESSION['login_user'] . '" disabled="true">
        
            <br><label class="label">Mật khẩu cũ:</label>
            <input style="width: 282px" type="password" name="pass" required>
        
            <br><label class="label">Mật khẩu mới:</label>
            <input style="width: 270px" type="password" name="npass" required>
        
            <br><label class="label">Nhập lại mật khẩu mới:</label>
            <input style="width: 206px" type="password" name="rnpass" required>
        
            <br><br><input class="sm" type="submit" name="submit-pass" value= "Đổi mật khẩu">
        </form>
    </div>';
    }
    ?>
</body>

<?php
	include 'config.php';
	
	if(isset($_POST['submit-pass'])) {
		$pass = $_POST['pass'];
		$newpass = $_POST['npass'];
		$rnewpass = $_POST['rnpass'];
		$user = $_SESSION['login_user'];

		if($pass == $_SESSION['login_pass']) {
			if($newpass === $rnewpass) {
				$sql = "UPDATE taikhoan SET MatKhau='$newpass' WHERE TenTK='$user'";
				if(mysqli_query($conn, $sql)) {
					echo "<script>
						alert('Thay đổi thành công! Vui lòng đăng nhập lại.');
						window.location.href = 'login.php';
						</script>";
				}
				else {
					echo "<script>
						alert('Lỗi!');
						</script>";
				}
			}
			else {
				echo "<script>
						alert('Nhập lại mật khẩu mới không đúng!');
						</script>";
			}
		}
		else {
			echo "<script>
				alert('Mật khẩu cũ không đúng!');
				</script>";
		}
		mysqli_close($conn);
	}
?>
</html>