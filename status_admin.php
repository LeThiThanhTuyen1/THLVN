<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Sân bóng TTVHO</title>
<?php
	include("config.php");
	include("header_admin.php");
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
    <div class="status-div">
        <b>TRẠNG THÁI SÂN BÓNG <span id='tieudetime'></span></b><br />
        <br>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sân</th>
                    <th>Trạng Thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt =1;

                $sql_tt = "SELECT TenSan,
                        IF(TrangThai = 1, 'Đang hoạt động', 'Đang bảo trì') AS TrangThai
                        FROM sanbong";
                $result_tt = mysqli_query($conn, $sql_tt);

                // Duyệt qua kết quả
                while ($row = mysqli_fetch_assoc($result_tt)) {
                    echo '<tr>';
                    echo '<td>' . $stt . '</td>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    echo '<td>' . $row['TrangThai'] . '</td>';
                    echo '<td><input style="color: red" type="submit" name="edit-status['.$row['TenSan'].']" value="Sửa"/></td>';
                    echo '</tr>';
                    $stt++;
                }

                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <button><a href="home.php">Quay lại</a></button>
    </div>
</body>