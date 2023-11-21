<html>
<head>
    <meta charset="UTF-8">
    <title>Thanh toán đặt sân bóng</title>
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
            echo "Lỗi: Không có ID sân được chỉ định.";
            exit;
        }

        if(isset($_POST['luu'])) {
           


                $sql = "UPDATE datsan SET DaThanhToan = 1 WHERE MaDat = '$id'";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                    alert('Bạn đã thanh toán thành công!');
                    window.location = 'danhsachdat.php';
                    </script>";
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }

        $sql = "SELECT ThanhTien FROM datsan WHERE MaDat = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Lỗi: Không tìm thấy thông tin đặt sân";
            exit;
        }
    ?>
   <div class="add">
        <h1>Thanh toán tiền đặt sân</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="tenKhachHang">Tên chủ tài khoản:</label>
            <input type="text" name="tenTK" id="tenKhachHang" value="" required><br>

            <label for="email">Số tài khoản:</label>
            <input type="text" name="number" id="email" value="" required><br>

            <label for="soDT">Số tiền phải thanh toán:</label>
            <input type="text" name="soDT" id="soDT" value="<?= $row['ThanhTien'] ?>" required><br>

            <input type="submit" name="luu" value="Thanh toán">
        </form>
    </div>
</body>
</html>
