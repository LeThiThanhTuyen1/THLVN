<?php
    // Kết nối với database
    include 'config.php';

    if(isset($_POST['xuat'])) {
        // Include thư viện PHPExcel_IOFactory vào
        include 'PHPExcel/Classes/PHPExcel/IOFactory.php';

        // Loại file cần ghi là file excel phiên bản 2007 trở đi 
        $fileType = 'Excel2007';
        // Tên file cần ghi
        $fileName = 'danhsachdatsan.xlsx';

        // Lấy danh sách đặt sân từ database
        $sql = "SELECT * FROM datsan";
        $result = $conn->query($sql);

        // Tạo file excel mới
        $objPHPExcel = new PHPExcel();

        // Lấy sheet Excel đang hoạt động
        $sheet = $objPHPExcel->getActiveSheet();

        // Thiết lập tên các cột dữ liệu
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "Mã đặt")
            ->setCellValue('B1', "Tên Sân")
            ->setCellValue('C1', "Tên khách hàng")
            ->setCellValue('D1', "Giờ đặt")
            ->setCellValue('E1', "Giờ trả")
            ->setCellValue('F1', "Đã thanh toán")
            ->setCellValue('G1', "Thành tiền");

        // Lặp qua các kết quả truy vấn và ghi dữ liệu vào file excel
        $i = 2;

        $sql = "SELECT sanbong.TenSan,datsan.*
                FROM datsan INNER JOIN sanbong
                ON sanbong.ID = datsan.IDSan ";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $ID = $row['MaDat'];
            $tenSan = $row['TenSan'];
            // Lấy tên khách hàng theo mã khách
            $tenkh = $row['TenTK'];
            $sql2 = "SELECT khachhang.TenKH 
                            FROM khachhang INNER JOIN taikhoan
                            ON khachhang.Email = taikhoan.Email
                            WHERE TenTK = '$tenkh'";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $tenKH= $row2['TenKH'];
            $gioDat = $row['GioDat'];
            $gioTra = $row['GioTra'];
            $daThanhToan = $row['DaThanhToan'];
            $tien = $row['ThanhTien'];
            
            $sheet->setCellValue("A$i", $ID);
            $sheet->setCellValue("B$i", $tenSan);
            $sheet->setCellValue("C$i", $tenKH);
            $sheet->setCellValue("D$i", $gioDat);
            $sheet->setCellValue("E$i", $gioTra);
            if ($daThanhToan == 1) {
                $sheet->setCellValue("F$i", "✓");
            } else {
                $sheet->setCellValue("F$i", "✗");
            }
            $sheet->setCellValue("G$i", $tien);

            $i++;
        }

        // Đóng kết nối với database
        $conn->close();

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
        
        // Tiến hành ghi file
        $objWriter->save($fileName);

        $success = true;
        if ($objWriter->save($fileName)) {
            $success = false;
        } 
        // Hiển thị thông báo
        if ($success) {
            echo "<script>
            alert('Đã ghi vào file danhsachdatsan.xlsx!');
            window.history.back();
            </script>";
        } else {
            echo "<script>
            alert('Ghi file không thành công!');
            window.history.back();
            </script>";
        }
    }
?>
