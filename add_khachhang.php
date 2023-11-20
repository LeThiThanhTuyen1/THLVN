<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
		body {
			font-family: 'Poppins', sans-serif;
			background: #125c0b;
		}
		.add {
			margin-top: 20px!important;
			width: 500px;
			background: #f1f1f1;
			margin: 100px auto;
			padding: 20px 30px;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px hsl(128, 80%, 49%);
		}
		.add h1 {
			text-align: center;
			margin-bottom: 30px;
			color: #1ae034;
		}
		.add form {
			display: flex;
			flex-direction: column;
		}
		.add form label {
			font-weight: bold;
			font-size: 16px;
			color: #555;
			margin-bottom: 10px;
			display: flex;
			align-items: center;
		}

		.add form input[type="text"], .add form input[type="file"] {
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			background: #f9f9f9;
		}
		.add form input[type="submit"] {
			background: #125c0b;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px;
			font-size: 18px;
			cursor: pointer;
		}
	</style>
</head>
<body>
    <?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tenKhachHang = $_POST['tenKhachHang'];
        $email = $_POST['email'];
        $soDT = $_POST['soDT'];

            $sql = "INSERT INTO khachhang ( TenKH, Email, SoDT)
                    VALUES ( '$tenKhachHang', '$email', '$soDT')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>
                    alert('Thêm khách hàng thành công!');
                    window.location.href='khachhang_admin.php';
                </script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
    ?>

    <div class="add">
        <h1>Nhập thông tin khách hàng</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			<label for="tenKhachHang"> Tên Khách Hàng:</label>
			<input type="text" name="tenKhachHang" id="tenKhachHang" required >

			<label for="email">Email:</label>
			<input type="text" name="email" id="email" required >

			<label for="gia">Số Điện Thoại:</label>
			<input type="text" name="soDT" id="soDT" required >

				
			<br><input type="submit" value="Thêm">         
        </form>
    </div>
</body>
</html>

