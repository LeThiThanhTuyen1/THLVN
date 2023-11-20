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
    </style>
       <script>
        function confirmDelete(id) {
            var result = confirm("Bạn có chắc muốn xóa khách hàng này?");
            if (result) {
                window.location.href = 'edit_khachhang.php?id=' + id;
            }
        }
    </script> 
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
    <div class="status-div">
        <b>DANH SÁCH KHÁCH HÀNG</b><br />
        <br>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>MaKH</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM khachhang";
                $result = mysqli_query($conn, $sql);

                // Duyệt qua kết quả
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="edit_khachhang.php" method= "POST" id="add-form">';
                        echo '<tr>';
                        echo '<td>' . $row['MaKH'] . '</td>';
                        echo '<td>' . $row['TenKH'] . '</td>';
                        echo '<td>' . $row['Email'] . '</td>';
                        echo '<td>' . $row['SoDT'] . '</td>';
                        echo '<td><input class="btn" type ="submit" name="suakh['.$row['MaKH'].']" value="Sửa"></td>';
                    //echo '<td><input class="btn" type ="submit" name="xoasb['.$row['ID'].']" value="Xóa"></td>';
                    echo '<td><input class="btn" type="button" value="Xóa" onclick="confirmDelete('.$row['MaKH'].')"></td>';
                    echo '</tr>';
                }

                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <input class="btn" type="submit" name="themmoi" value= "Thêm mới">
            </form>
    </div>
</body>
</html>
