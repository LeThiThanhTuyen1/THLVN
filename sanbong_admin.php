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
            var result = confirm("Bạn có chắc muốn xóa sân bóng này?");
            if (result) {
                window.location.href = 'edit_sanbong.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php';
    ?>
    <form action="search-pitch.php" method="GET">
        <input type="text" placeholder="Nhập tên hoặc loại sân bóng muốn tìm" class="search" name="timkiem"/>
        <input class="search-bt" type="submit" name="search-sb" value="Tìm"/><br>
    </form>
    <div class="status-div">
        <b>DANH SÁCH SÂN BÓNG <span id='tieudetime'></span></b><br />
        <br>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sân</th>
                    <th>Ảnh sân</th>
                    <th>Loại sân</th>
                    <th>Giá</th>
                    <th>Địa điểm</th>
                    <th>Mô tả</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM sanbong";
                $result = mysqli_query($conn, $sql);

                // Duyệt qua kết quả
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="edit_sanbong.php" method= "POST" id="add-form">';
                    echo '<tr>';
                    echo '<td>' . $row['ID'] . '</td>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    echo '<td> <img width="100" height="50" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'"> </td>';
                    echo '<td>' . $row['LoaiSan'] . '</td>';
                    echo '<td>' . $row['Gia'] . '</td>';
                    echo '<td>' . $row['DiaDiem'] . '</td>';
                    echo '<td>' . $row['MoTa'] . '</td>';
                    echo '<td><input class="btn" type ="submit" name="suasb['.$row['ID'].']" value="Sửa"></td>';
                    //echo '<td><input class="btn" type ="submit" name="xoasb['.$row['ID'].']" value="Xóa"></td>';
                    echo '<td><input class="btn" type="button" value="Xóa" onclick="confirmDelete('.$row['ID'].')"></td>';
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
