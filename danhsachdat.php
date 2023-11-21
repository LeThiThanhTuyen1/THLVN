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
            margin: auto;
        }
        th, td {
            padding: 10px;
        }
        body {
            background-color: #125c0b;
        }
        button {
            padding: 5px;
            margin-right: 100px;
        }
        a {
            text-decoration: none;
            color: red;
        }
        .btn-thanhtoan {
            padding: 5px 15px;
            margin-left: 10px;
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header.php';
    ?>
    <div class="status-div">
        <h2>DANH SÁCH SÂN ĐÃ ĐẶT</h2>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Mã đặt</th>
                    <th>Tên sân</th>
                    <th>Giờ đặt</th>
                    <th>Giờ trả</th>
                    <th>Thành Tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM danhsachdat";
                $result = mysqli_query($conn, $sql);

                // Duyệt qua kết quả
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['MaDat'] . '</td>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    echo '<td>' . $row['GioDat'] . '</td>';
                    echo '<td>' . $row['GioTra'] . '</td>';
                    echo '<td>' . $row['ThanhTien'] . '</td>';
                    echo '<td><input class="btn" type ="submit" name="" value="Hủy"></td>';
                    echo '</tr>';
                }
                
                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <button><a href="sanbong.php">Quay lại trang sân bóng</a></button>
        <button class="btn-thanhtoan"><a href="thanhtoansan.php">Thanh Toán</a></button>
    </div>
</body>
</html>
