<html>
<head>
    <meta charset="UTF-8">
    <title>DANH SÁCH YÊU THÍCH</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #125c0b;
        }
        .box {
            margin-left: 100px;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border: 5px inset coral;
            width: 35%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
        }
        .box img {
            max-width: 300px;
            display: inline-block;
            vertical-align: middle;
        }
        .box h2{
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
            
        }
        .favorite-button {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            margin-bottom:10px;
            color: #ec0909;
        }
        
        .box c {
            display: block;
            vertical-align: middle;
            color: green;
        }
        .sanbong-div {
            margin-left: 50px;
        }
        .search-bt {
            height: 25px;
            margin-left: 5px;
            width: 60px;
            color: red;
        }
        .search {
            height: 25px;
            width: 400px;
            margin-left: 12.5%;
            margin-top: 80px;
        }
        .status-div-rong {
            margin: 12.5%;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
            margin-top: 15px;
            padding: 10px 40px;
        }
    </style>
</head>
<body>
    <?php
        include 'config.php';
        include 'header.php';
    ?>
     <form action="search.php" method="GET">
        <input type="text" placeholder="Nhập tên hoặc loại sân bóng muốn tìm" class="search" name="timkiem"/>
        <input class="search-bt" type="submit" name="search-sb" value="Tìm"/><br>
    </form>
    <?php 



if(isset($_POST['huyyeuthich']))
        {
            $id=$_POST['huyyeuthich_id'];
            $sql = "DELETE from sanyeuthich  where ID= '$id'";
            $result = mysqli_query($conn, $sql);
        }

    $id= $_SESSION['login_user'];;
    $sql = "SELECT *, sanyeuthich.ID as idyeu
    FROM sanyeuthich,sanbong where sanyeuthich.TenTK= '$id' and sanbong.ID =sanyeuthich.IDSan";

$products = mysqli_query($conn, $sql);
    if (mysqli_num_rows($products) == 0) {
        echo '<div class="status-div-rong"><p>Không có sân bóng nào được tìm thấy.</p></div>';
    } else {
        echo '<div class="sanbong-div">';
        while ($row = mysqli_fetch_assoc($products)) {
        echo '<div class="box">
        <form method="POST" action="sanyeuthicch.php">
                <img width="100" height="50" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'">
                
                <h2>' . $row['TenSan'] . '</h2>';
                echo '<input type="hidden" name="huyyeuthich_id" value="' . $row['idyeu'] . '">';
                    echo '<button  type="submit" name="huyyeuthich" class="favorite-button"> Hủy ❤️</button>';
                
                echo '<c>Giá: ' . $row['Gia'] . 'đ</c>
                <c>Loại sân: ' . $row['LoaiSan'] . '</c>
            </form>
            <form method="POST" action="datsan.php">
                <br><input type="submit" name="datsan['.$row['ID'].']" class="btn" value="Đặt sân">
                </form>
        </div>';     
        }
        echo '</div>';
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".favorite-button").click(function() {
                var sid = $(this).data("sid");
                var icon = $(this);

                $.post("add_yeuthich.php", { sid: sid }, function(data) {
                    if (data === "success") {
                        icon.addClass("favorite");
                    }
                });
            });
        });
    </script>
</body>
</html>

