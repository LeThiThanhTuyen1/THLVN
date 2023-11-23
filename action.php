<html>
<header>
    <style>
        body {
            background-color: #125c0b;
            font-size: 18px;
        }
        .detail-div {
            text-align: center;
            margin: 12.5%;
            margin-top: 100px;
            padding: 40px;
            border: 5px inset coral;
            width: 1000px;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            color: #ec0909;
        }
        .back-button {
            margin-right: 20px;
            margin-bottom: 10px;
        }
        .back-a {
            text-decoration: none;
            color: red;
        }
        #datetimePicker{
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            color: #ec0909;
			border-radius: 5px;
			padding: 10px;
			font-size: 18px;
			cursor: pointer;
        }
    </style>
    <script>
        function confirmAddlike(id) {
            var result = confirm("Bạn có chắc muốn thêm sân bóng này vào danh sách yêu thích?");
            if (result) {
                window.location.href = 'add_yeuthich.php?id=' + id;
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</header>
<body>
<?php
    include('config.php');
    include('header.php');
    
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['login_user'];
        $loggedIn = true;
    } else {
        $username = 'guest';
        $loggedIn = false;
    }

    if(isset($_POST['chitiet'])&&$_POST['chitiet']) {
        $sanBongId = $_POST['id'];
        $sql = "SELECT * FROM sanbong where ID = '$sanBongId' ";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_array($result)) {
            echo '<div class="detail-div">
                    <form method="post" action="">
                        <img width="600" height="350" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'">
                        <h2>' . $row['TenSan'] . '</h2>
                        Giá: ' . $row['Gia'] . '
                        <br>Loại sân: ' . $row['LoaiSan'] . '</c>
                        <br>Mô tả: ' . $row['MoTa'] . '</c>
                        <br><br>
                        <button  class="back-button"><a class="back-a" href="sanbong.php">Trở về</a></button>';
                        if ($loggedIn) {
                            echo '<input class="favorite-button" type="button" value="❤️" onclick="confirmAddlike('.$row['ID'].')">';
                        }
                echo '</form>
                </div>';
        }
    }   
    if(isset($_POST['datsan'])&&$_POST['datsan']) {
        if($loggedIn){
            $idSan = $_POST['id'];
            if (isset($_SESSION['login_user'])) {
                $username = $_SESSION['login_user'];

                $sql = "SELECT * FROM sanbong WHERE ID = '$idSan'";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_array($result)) {
                    echo '<div class="detail-div">
                        <form method="post" action="datsan.php">
                            <img width="600" height="350" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'">
                            <input type="hidden" name="id" value=" '.$row['ID'].' ">
                            <input type="hidden" name="price" value=" '.$row['Gia'].' ">
                            <h2>' . $row['TenSan'] . '</h2>
                            Giá: ' . $row['Gia'] . '
                            <br>Loại sân: ' . $row['LoaiSan'] . '</c>
                            <br>Mô tả: ' . $row['MoTa'] . '</c>
                            <br><br><input type="text" id="datetimePicker" name="Timedatsan" placeholder="Chọn thời gian đặt sân">
                            <br><br><input type="text" id="datetimePicker" name="Timetrasan" placeholder="Chọn thời gian trả sân">
                            <br><br><input type="submit" name="DatSan['.$row['ID'].']" class="btn" value="Đặt sân">
                            <button  class="back-button"><a class="back-a" href="sanbong.php">Trở về</a></button>
                            </form>
                    </div>';
                    echo '<script>
                        flatpickr("#datetimePicker", {
                            enableTime: true,
                            minDate: "today",
                            dateFormat: "Y-m-d H:i",
                        });
                    </script>';
                }
            }
        }else{
            echo "<script>
                alert('Vui lòng đăng nhập tài khoản!');
                window.location.href='login.php';
            </script>";
        }
    }else {
        echo "error";
    }
?>
   
</body>