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
    </style>
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
    
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
    $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
    $offset = ($current_page - 1) * $item_per_page;
    $products = mysqli_query($conn, "SELECT * FROM `sanbong` ORDER BY `ID` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
    $totalRecords = mysqli_query($conn, "SELECT * FROM `sanbong`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);

    if(isset($_POST['chitiet'])&&$_POST['chitiet']) {
        $sanBongId = $_POST['id'];
        $sql = "SELECT * FROM sanbong where ID = '$sanBongId' ";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_array($result)) {
            echo '<div class="detail-div">
                    <form method="post" action="action.php">
                        <img width="600" height="350" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'">
                        <h2>' . $row['TenSan'] . '</h2>
                        Giá: ' . $row['Gia'] . '
                        <br>Loại sân: ' . $row['LoaiSan'] . '</c>
                        <br>Mô tả: ' . $row['MoTa'] . '</c>
                        <br><br>
                        <button  class="back-button"><a class="back-a" href="sanbong.php">Trở về</a></button>';
                        if ($loggedIn) {
                            echo '<button name="add-favorite" class="favorite-button" data-sid="'.$row['ID'].'">❤️</button>';
                        }
                        echo                         
                            '<input type="submit" name="datsan['.$row['ID'].']" class="btn" value="Đặt sân">
                    </form>
                </div>';
        }
    }   
    else if(isset($_POST['datsan'])&&$_POST['datsan']) {
        header('location: datsan.php');
    }
    else if(isset($_POST['add-favorite'])) {
        header('location: sanbong.php');
    }
    else {
        echo "error";
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