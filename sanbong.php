<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng TTVHO</title>
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
            background-color: white;
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
    </style>
    <script>
        function confirmAddlike(id) {
            var result = confirm("Bạn có chắc muốn thêm sân bóng này vào danh sách yêu thích?");
            if (result) {
                window.location.href = 'add_yeuthich.php?id=' + id;
            }
        }
        function confirmDatSan(id) {
                window.location.href = 'form_datsan.php?id=' + id;
        }
        
    </script>
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

    if (mysqli_num_rows($products) == 0) {
        echo '<p>Không có sân bóng nào được tìm thấy.</p>';
    } else {
        echo '<div class="sanbong-div">';
        while ($row = mysqli_fetch_assoc($products)) {
        echo '<div class="box">
            <form method="post" action="action.php">
                <img width="100" height="50" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'">
                <input type="hidden" name="id" value=" '.$row['ID'].' ">
                <input type="hidden" name="price" value=" '.$row['Gia'].' ">
                <h2>' . $row['TenSan'] . '</h2>';
                if ($loggedIn) {
                    echo '<input class="favorite-button" type="button" value="❤️" onclick="confirmAddlike('.$row['ID'].')">';

                }
                echo '<c>Giá: ' . $row['Gia'] . 'đ</c>
                <c>Loại sân: ' . $row['LoaiSan'] . '</c>
                <br>';
               echo '<input type="submit" name="datsan['.$row['ID'].']" class="btn" value="Đặt sân">';
                echo '<input type="submit" name="chitiet['.$row['ID'].']" class="btn" value="Chi tiết">
            </form>
        </div>';     
        }
        echo '</div>';
    }
    ?>
    
</body>
<footer>
    <?php include 'pagination.php'; ?>
</footer>
</html>
