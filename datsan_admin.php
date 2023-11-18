<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng TTVHO</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .status-div {
            text-align: center;
            margin: 12.5%;
            margin-top: 100px;
            padding: 10px 40px;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
        }
        .table-status {
            text-align: center;
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
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php';
    ?>
    <div class="status-div">
        <h2>DANH SÁCH ĐẶT SÂN</h2>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Mã đặt</th>
                    <th>Tên sân</th>
                    <th>Tên khách hàng</th>
                    <th>Giờ đặt</th>
                    <th>Giờ trả</th>
                    <th>Đã thanh toán</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM datsan";
                $result = mysqli_query($conn, $sql);

                // Duyệt qua kết quả
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="xuat_excel.php" method= "POST" id="add-form">';
                    echo '<tr>';
                    echo '<td>' . $row['MaDat'] . '</td>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    $maKH = $row['MaKhach'];
                    // Lấy tên khách hàng theo mã khách
                    $sql2 = "SELECT TenKH FROM khachhang WHERE MaKH = $maKH";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    echo '<td>' . $row2['TenKH'] . '</td>';
                    echo '<td>' . $row['GioDat'] . '</td>';
                    echo '<td>' . $row['GioTra'] . '</td>';
                    echo '<td>' . $row['DaThanhToan'] . '</td>';
                    echo '<td>' . $row['ThanhTien'] . '</td>';
                    echo '</tr>';
                }
                
                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <input class="btn" type="submit" name="xuat" value= "Ghi file excel">
        </form>
        </div>
</body>
</html>
