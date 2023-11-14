<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng TTVHO</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
   <style>
        body {
            background-color: #125c0b;
        }
        .box {
            margin-left: 100px;
            text-align: center;
            margin-top: 70px;
            padding: 10px;
            border: 5px inset coral;
            width: 80%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
        }
        .box-1 {
            text-align: center;
            border: 5px black;
            width: 27%; 
            margin: 25px;
            background-color: #ffffff;
            display: inline-block;
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
        .tieude {
            font-size: 20px;
        }
        .dieuhuong {
            float: right!important;
            
        }
        .dieuhuong a {
            text-decoration: none;
            color: red;
            margin-right: 5px;
        }
        .table-status {
            text-align: center;
            margin: auto;
        }
        th, td {
            padding: 10px;
        }
</style>
    </style>
</head>
<body>
    <?php
    session_start();
    include 'config.php';
    include 'header_admin.php'; 

    $sql_sb = "SELECT * FROM sanbong ORDER BY ID ASC LIMIT 6";
    $sql_kh = "SELECT * FROM khachhang";
    $rs_sb = mysqli_query($conn, $sql_sb);
    $rs_kh = mysqli_query($conn, $sql_kh);

    echo '
        <div class="">
            <div class="box">';
                echo '<b class="tieude">SÂN BÓNG</b>
                <div class="dieuhuong"><a href="sanbong_admin.php">Tùy chỉnh</a><i class="fas fa-chevron-right" style="color:red;"></i></div><br>';
                while($row_sb = mysqli_fetch_assoc($rs_sb)) {
                    echo '<div class="box-1">
                        <form method="post" action="">
                            <img width="100" height="50" src="data:image/jpeg;base64,'.base64_encode($row_sb["AnhSan"]).'">
                            <input type="hidden" name="id" value=" '.$row_sb['ID'].' ">
                            <h2>' . $row_sb['TenSan'] . '</h2>
                            <c>Giá: ' . $row_sb['Gia'] . 'đ</c>
                            <c>Loại sân: ' . $row_sb['LoaiSan'] . '</c>
                        </form>
                    </div>';     
                }
    echo
            '</div>
            <div class="box" style="margin-top: 50px!important">';
            echo '<b class="tieude">KHÁCH HÀNG</b>
            <div class="dieuhuong"><a href="khachhang_admin.php">Tùy chỉnh</a><i class="fas fa-chevron-right" style="color:red;"></i></div><br><br>';
            echo 
            '<table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Mã khách</th>
                    <th>Tên khách</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                </tr>
            </thead>
            <tbody>';
                while ($row_kh = mysqli_fetch_assoc($rs_kh)) {
                    echo '<tr>';
                    echo '<td>' . $row_kh['MaKH'] . '</td>';
                    echo '<td>' . $row_kh['TenKH'] . '</td>';
                    echo '<td>' . $row_kh['Email'] . '</td>';
                    echo '<td>' . $row_kh['SoDT'] . '</td>';
                    echo '</tr>';
                }

                // Đóng kết nối
                mysqli_close($conn);
                echo '
            </tbody>
        </table>';
    echo
            '<br></div>
        </div>';
    ?> 
</body>
</html>
