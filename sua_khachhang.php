<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa Khách Hàng</title>
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
		font-size: 18px;
		color: #555;
		margin-bottom: 10px;
		display: flex;
		align-items: center;
           	margin-top: 10px;
	}
    .add form input[type="text"], .add form input[type="file"] {
		padding: 10px;
		border-radius: 5px;
		border: none;
		background: #f9f9f9;
		margin-bottom: 20px;
	}
        .add form input[type="text"] {
            margin-bottom: -20px;
        }
        textarea {
            height: 50px;
            margin-bottom: -20px;
        }
	.add form input[type="submit"] {
        margin-top: 30px;
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
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            echo "Lỗi: Không có ID khách hàng được chỉ định.";
            exit;
        }

        if(isset($_POST['luu'])) {
            $tenKhachHang = $_POST['tenKhachHang'];
            $email = $_POST['email'];
            $soDT = $_POST['soDT'];


                $sql = "UPDATE khachhang SET TenKH = '$tenKhachHang', Email = '$email', SoDT = '$soDT' WHERE MaKH = $id";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                    alert('Khach hang đã được cập nhật thành công!');
                    window.location = 'khachhang_admin.php';
                    </script>";
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }

        $sql = "SELECT * FROM khachhang WHERE MaKH = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Lỗi: Không tìm thấy thông tin khach hang.";
            exit;
        }
    ?>
   <div class="add">
        <h1>Sửa thông tin khách hàng</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="tenKhachHang">Tên khách hàng:</label>
            <input type="text" name="tenKhachHang" id="tenKhachHang" value="<?= $row['TenKH'] ?>" required><br>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?= $row['Email'] ?>" required><br>

            <label for="soDT">Số Điện Thoại:</label>
            <input type="text" name="soDT" id="soDT" value="<?= $row['SoDT'] ?>" required><br>

            <input type="submit" name="luu" value="Lưu">
        </form>
    </div>
</body>
</html>
