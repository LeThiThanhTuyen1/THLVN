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
            margin-left: 30%;
            color: red;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header.php';

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM taikhoan
        INNER JOIN khachhang ON taikhoan.email = khachhang.email
        WHERE taikhoan.email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);
    echo '<div class="status-div">
        <h1>THÔNG TIN TÀI KHOẢN</h1>
        <form action="setting_submit.php" method="POST">
            <label class="label">Tên tài khoản:</label>
            <input style="background-color: #FFE4B5"  value=" '. $_SESSION['login_user'] . '" disabled="true">
        
            <br><label class="label">Họ và tên:</label>
            <input style="width: 232px" value="'. $row['TenKH']. '" type="text" name="ten" required>
        
            <br><label class="label">Email:</label>
            <input style="width: 258px; background-color: #FFE4B5" value="'.  $row['Email'] . '" disabled="true" name="mail">
        
            <br><label class="label">Số điện thoại:</label>
            <input style="width: 206px" value="'.  $row['SoDT'] . '"  type="text" name="sdt" required>
        
            <br><br><input class="sm" type="submit" name="submit-tt" value= "Cập nhật">
            <input class="sm" type="submit" name="submit-pass" value= "Đổi mật khẩu">
        </form>
    </div>';
    }
    ?>
</body>
</html>