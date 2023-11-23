<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Chỉnh trạng thái sân </title>
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

        .add form input[type="text"] {
            margin-bottom: -20px;
        }

        textarea {
            height: 50px;
            margin-bottom: -20px;
        }

        .add form input[type="radio"] {
            margin-bottom: 10px;
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
        echo "Lỗi: Không có ID trạng thái sân bóng được chỉ định.";
        exit;
    }

    if (isset($_POST['luu'])) {
        $tenSan = $_POST['tenSan'];

        $trangThai = isset($_POST['trangThai']) ? 1 : 0;
        $sql_tt = "UPDATE sanbong SET TenSan = '$tenSan', TrangThai = $trangThai WHERE ID = $id";
        

        if (mysqli_query($conn, $sql_tt)) {
            echo "<script>
                    alert('Trạng thái đã được cập nhật thành công!');
                    window.location = 'status_admin.php';
                    </script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }

    $sql_tt = "SELECT * FROM sanbong WHERE ID = '$id'";
    $result_tt = mysqli_query($conn, $sql_tt);

    if (mysqli_num_rows($result_tt) > 0) {
        $row = mysqli_fetch_assoc($result_tt);
    } else {
        echo "Lỗi: Không tìm thấy thông tin sân bóng.";
        exit;
    }
    ?>
    <div class="add">
        <h1>Sửa trạng thái sân bóng</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="tenSan">Tên sân bóng:</label>
            <input type="text" name="tenSan" id="tenSan" value="<?= $row['TenSan'] ?>" required><br>
            <label for="trangThai"></label>
            <input type="checkbox" name="trangThai" id="trangThai" value="1"  <?php echo ($row['TrangThai'] == 1) ? 'checked' : ''; ?>>
            <br><input type="submit" name="luu" value="Lưu">&emsp;
        </form>
    </div>
</body>

</html>
