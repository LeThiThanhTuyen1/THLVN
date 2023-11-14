<html>
<head>
    <meta charset="UTF-8">
    <title>Sửa sân bóng</title>
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
            echo "Lỗi: Không có ID sân bóng được chỉ định.";
            exit;
        }

        if(isset($_POST['luu'])) {
            $tenSan = $_POST['tenSan'];
            $loaiSan = $_POST['loaiSan'];
            $gia = $_POST['gia'];
            $diaDiem = $_POST['diaDiem'];
            $moTa = $_POST['moTa'];
            $image = $_FILES['image'];

            if ($image) {
                $imageData = file_get_contents($image['tmp_name']);
                $imageData = mysqli_real_escape_string($conn, $imageData);

                $sql = "UPDATE sanbong SET TenSan = '$tenSan', AnhSan = '$imageData', LoaiSan = '$loaiSan', Gia = '$gia', DiaDiem = '$diaDiem', MoTa = '$moTa' WHERE ID = $id";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                    alert('Sân bóng đã được cập nhật thành công!');
                    window.location = 'sanbong_admin.php';
                    </script>";
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }
        }

        $sql = "SELECT * FROM sanbong WHERE ID = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Lỗi: Không tìm thấy thông tin sân bóng.";
            exit;
        }
    ?>
    <div class="add">
    <h1>Sửa thông tin sân bóng</h11>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="tenSan">Tên sân bóng:</label>
        <input type="text" name="tenSan" id="tenSan" value="<?= $row['TenSan'] ?>" required><br>

        <label for="loaiSan">Loại sân:</label>
        <input type="text" name="loaiSan" id="loaiSan" value="<?= $row['LoaiSan'] ?>" required><br>

        <label for="gia">Giá:</label>
        <input type="text" name="gia" id="gia" value="<?= $row['Gia'] ?>" required><br>

        <label for="diaDiem">Địa điểm:</label>
        <input type="text" name="diaDiem" id="diaDiem" value="<?= $row['DiaDiem'] ?>" required><br>

        <label for="moTa">Mô tả:</label>
        <textarea name="moTa" id="moTa" required><?= $row['MoTa'] ?></textarea><br>

        <label for="image">Ảnh sân bóng:</label>
		<input type="file" name="image" id="image"
        img width="100" height="50" src="data:image/jpeg;base64,<?=base64_encode($row["AnhSan"])?>" required> 

        <input type="submit" name="luu" value="Lưu">
    </form>
    </div>
</body>
</html>
