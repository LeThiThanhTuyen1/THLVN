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
        }
        a {
            text-decoration: none;
            color: red;
        }
        p {
            font-weight: bold;
            border: 5px inset coral; 
            padding: 10px;
            display: inline-block; 
            font-size: 26px;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php';
    ?>
    <div class="status-div">
        <h2>THỐNG KÊ DOANH THU</h2>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Tên Sân</th>
                    <th>Tổng Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Câu truy vấn SQL
                $sql = "SELECT sanbong.TenSan, SUM(datsan.ThanhTien) AS TongTien
                FROM datsan
                INNER JOIN sanbong
                ON sanbong.ID = datsan.IDSan
                GROUP BY datsan.IDSan
                ORDER BY TongTien ASC";
                $result = $conn->query($sql);
                
                // Kiểm tra và hiển thị kết quả
                $sum = mysqli_num_rows($result);
                if ($sum > 0) {
                    echo "<tr></tr>";

                    // Xuất dữ liệu mỗi hàng
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo 
                            "<tr>
                                <td>" . $row["TenSan"] . "</td>
                                <td>" . $row["TongTien"] . "</td>
                            </tr>";
                    }
                    echo "</table>";

                    $totalAll = $conn->query("SELECT SUM(ThanhTien) AS TongAll FROM datsan")->fetch_assoc();
                    echo "<p>Tổng tất cả: " . $totalAll["TongAll"] . "</p>";
                } else {
                    echo "Không có dữ liệu";
                }    
                
                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <button><a href="home.php">Quay lại trang chủ</a></button>
    </div>
</body>
</html>
