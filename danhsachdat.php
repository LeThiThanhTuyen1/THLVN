<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Sân bóng TTVHO</title>
<?php
	include("config.php");
	include("header.php");
?>
<header>
    <style>
        body {
            background-color: #125c0b;
            font-size: 18px;
        }
        .status-div {
            text-align: center;
            margin: 12.5%;
            margin-top: 100px;
            padding: 40px;
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
        button {
            padding: 5px;
        }
        a {
            text-decoration: none;
            color: red;
        }
    </style>  
</header>
<body>
    <?php
        if(isset($_GET['id'])) {
            $timestamp = time();
            $id1 = $_GET['id'];
        
            // Chuyển timestamp thành ngày/tháng
            $date = date('Y-m-d', $timestamp);
        
            // Cộng thêm 1 ngày
            $nextDay = date('Y-m-d', strtotime($date . ' +1 day'));

            $sql_tt = "SELECT * FROM datsan WHERE MaDat = '$id1' AND GioDat < '$nextDay'";
            $result_tt = mysqli_query($conn, $sql_tt);
            if(mysqli_num_rows($result_tt) > 0)
            {
                $sql_tt1 = "DELETE FROM datsan WHERE MaDat = '$id1' AND GioDat < '$nextDay'";
                $result_tt1 = mysqli_query($conn, $sql_tt1);
                echo  '<script>alert("Xóa thành công!");</script>';

            }
            else
            {
                echo  '<script>alert("Không thành công!");</script>';
            }
        }
    ?>
    <div class="status-div">
        <b>DANH SÁCH ĐẶT SÂN <span id='tieudetime'></span></b><br />
        <br>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Mã đặt</th>
                    <th>Tên Sân</th>
                    <th>Giờ đặt</th>
                    <th>Giờ trả</th>
                    <th colspan="2">Cập nhật </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_SESSION['login_user'])) {
                        $username = $_SESSION['login_user'];
                        
                        $sql_tt = "SELECT datsan.MaDat, sanbong.TenSan, datsan.GioDat, datsan.GioTra, datsan.MaDat, datsan.DaThanhToan
                                FROM datsan INNER JOIN sanbong
                                ON sanbong.ID = datsan.IDSan 
                                WHERE datsan.TenTK = '$username'";
                        $result_tt = mysqli_query($conn, $sql_tt);

                        // Duyệt qua kết quả
                        while ($row = mysqli_fetch_assoc($result_tt)) {
                            echo '<form action="edit_trangthai.php" method= "POST" id="add-form">';
                            echo '<tr>';
                            echo '<td>' . $row['MaDat'] . '</td>';
                            echo '<td>' . $row['TenSan'] . '</td>';
                            echo '<td>' . $row['GioDat'] . '</td>';
                            echo '<td>' . $row['GioTra'] . '</td>';
                            echo '<td> <a href= "danhsachdat.php?id=' . $row['MaDat'] . '" > Hủy</a></td>';
                            if($row['DaThanhToan'] == 1)
                            {
                                echo '<td>' . 'Đã thanh toán' . '</td>';
                            } else
                            {
                            echo '<td> <a href= "thanhtoansan.php?id=' . $row['MaDat'] . '" > Thanh toán</a></td>';
                            }
                            echo '</tr>';
                        }
                    }
                    // Đóng kết nối
                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <button><a href="sanbong.php">Quay lại</a></button>
    </div>
</body>
