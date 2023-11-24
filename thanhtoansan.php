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
        margin-left: 20%;
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
        if(isset($_POST['huy'])) {
            header('location: danhsachdat.php');
        }
        if(isset($_POST['luu'])) {
            $stk = $_POST['stk'];
            $ten = $_POST['tenTK'];
            if(!empty($ten)) {
                if(!empty($stk)) {
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
                else {
                    echo "<script>
							alert('Vui lòng nhập số tài khoản!');
							window.location.back();
							</script>";
                }
            }
            else {
                echo "<script>
							alert('Vui lòng nhập tên chủ tài khoản!');
							window.location.back();
							</script>";
            }
        }

        $sql = "SELECT * FROM datsan WHERE MaDat = $id";
        $result = mysqli_query($conn, $sql);
        
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
        } else {
            echo "Lỗi: Không tìm thấy thông tin đặt sân";
            exit;
        }
        $i = $row['IDSan'];
        $sql1 = "SELECT TenSan FROM sanbong where ID = $i";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
    ?>
   <div class="add">
        <h1>Thông tin thanh toán</h1>
        <form method="post" action="">
            <label for="tenKhachHang">Mã đặt:</label>
            <input type="text" name="madat" value="<?= $id ?>" disabled="true"><br>

            <label for="tenKhachHang">Tên Sân:</label>
            <input type="text" name="tensan"  value="<?= $row1['TenSan'] ?>" disabled="true" required><br>

            <label for="tenKhachHang">Tên chủ tài khoản:</label>
            <input type="text" name="tenTK" id="tenKhachHang" value="" ><br>

            <label for="email">Số tài khoản:</label>
            <input type="text" name="stk" id="stk" value="" ><br>

            <label for="soDT">Số tiền phải thanh toán:</label>
            <input type="text" name="tien" id="tien" disabled="true" value="<?= $row['ThanhTien'] ?>" required><br>

            <span><input type="submit" name="luu" value="Thanh toán"><input type="submit" name="huy" value="Hủy"></span>
        </form>
    </div>
</body>
</html>
