<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm Sân Bóng</title>
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
        $tenSan = $_POST["tenSan"];
        $loaiSan = $_POST["loaiSan"];
        $gia = $_POST["gia"];
        $diaDiem = $_POST["diaDiem"];
        $moTa = $_POST["moTa"];
        $image = $_FILES['image'];

        if ($image) {
            $imageData = file_get_contents($image['tmp_name']);
            $imageData = mysqli_real_escape_string($conn, $imageData);

            $sql = "INSERT INTO sanbong (TenSan, AnhSan, LoaiSan, Gia, DiaDiem, MoTa, TrangThai)
                    VALUES ('$tenSan', '$imageData', '$loaiSan', '$gia', '$diaDiem', '$moTa', 0)";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>
                    alert('Thêm sân bóng thành công!');
                    window.location.href='sanbong_admin.php';
                </script>";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
    }
    ?>

    <div class="add">
        <h1>Nhập thông tin sân bóng</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		   <label for="tenSan"> Tên sân bóng:</label>
		   <input type="text" name="tenSan" id="tenSan" required >

		   <label for="tenSan">Loại sân:</label>
		   <input type="text" name="loaiSan" id="loaiSan" required >

		   <label for="gia">Giá:</label>
		   <input type="text" name="gia" id="gia" required >

		   <label for="diaDiem">Địa điểm:</label>
		   <input type="text" name="diaDiem" id="diaDiem" required >

		   <label for="moTa">Mô tả:</label>
		   <input type="text" name="moTa" id="moTa" required >
		   
		   <label for="image">Ảnh sân bóng:</label>
		   <input type="file" name="image" id="image" accept="image/*" required>
		  
		   <br><input type="submit" value="Thêm">         
        </form>
    </div>
</body>
</html>

