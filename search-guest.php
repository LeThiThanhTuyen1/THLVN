<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng TTVHO</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .status-div {
            text-align: center;
            margin: 12.5%;
            margin-top: 15px;
            padding: 10px 40px;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
        }
        .table-status {
            text-align: center;
            margin: auto;
        }
        th, td {
            padding: 10px;
        }
        body {
            background-color: #125c0b;
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            color: #ec0909;
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
    include 'header_admin.php';
    ?>
    <form action="search-guest.php" method="GET">
        <input type="text" placeholder="Nhập tên khách hàng" class="search" name="timkiem"/>
        <input class="search-bt" type="submit" name="search-kh" value="Tìm"/><br>
    </form>
    <?php 
        if (isset($_GET['timkiem'])) {
            $timkiem = $_GET['timkiem'];
            if(empty($timkiem)) {
                echo '<script>
                    alert("Vui lòng nhập thông tin tìm kiếm!");
                    window.history.back(); 
                </script>';
            }
            else {
                $sql = "SELECT * FROM khachhang WHERE TenKH LIKE '%$timkiem%'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                if($num>0 && $timkiem!="") {
                    echo '<div class="status-div">
                        <b>KẾT QUẢ TÌM KIẾM <span id="tieudetime"></span></b><br />
                        <br>
                        <table class="table-status" border="1">
                            <thead>
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['MaKH'] . '</td>';
                                    echo '<td>' . $row['TenKH'] . '</td>';
                                    echo '<td>' . $row['Email'] . '</td>';
                                    echo '<td>' . $row['SoDT'] . '</td>';
                                    echo '<td><input class="btn" type ="submit" name="suasb['.$row['MaKH'].']" value="Sửa"></td>';
                                    echo '<td><input class="btn" type ="submit" name="xoasb['.$row['MaKH'].']" value="Xóa"></td>';
                                    echo '</tr>';
                                }    
                                mysqli_close($conn);
                            echo '</tbody>
                        </table>
                        <br>
                        <input class="btn" type ="submit" name="add" value="Thêm mới">
                    </div>';
                }
                else {
                    echo '<div class="status-div-rong">Không có kết quả nào được tìm thấy.</div>';
                }
            }
        }
    ?>
</body>
</html>
