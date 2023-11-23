<?php
    include 'config.php';
    function calculateTotal($start, $end, $pricePerHour) {
        $startTime = strtotime( $start);
        $endTime = strtotime($end);

        $hoursBooked = ($endTime - $startTime) / 3600;

        $total = $hoursBooked * $pricePerHour;
        return $total;
    }

    if (isset($_SESSION['login_user'])) {
        $username = $_SESSION['login_user'];

        if (isset($_POST['DatSan']) && $_POST['DatSan']) {
            $idSan = $_POST['id'];
            $price = $_POST['price'];
            $Timedatsan = $_POST['Timedatsan'];
            $Timetrasan = $_POST['Timetrasan'];
            $checkQuery = "SELECT * FROM datsan 
                        WHERE IDSan = '$idSan' 
                        AND GioDat <= '$Timedatsan' 
                        AND GioTra >= '$Timetrasan'";

            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo  "<script>
                        alert('Sân đã bị đặt trong khoảng thời gian này!');
                        window.location.href='sanbong.php';
                    </script>";
            } else {
                $totalAmount = calculateTotal($Timedatsan, $Timetrasan, $price);
                $insertQuery = "INSERT INTO datsan (IDSan, TenTK, GioDat, GioTra, ThanhTien, ThanhToan) 
                                VALUES ('$idSan', '$username', '$Timedatsan', '$Timetrasan', '$totalAmount',0)";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>
                            alert('Đặt sân thành công!');
                            window.location.href='sanbong.php';
                        </script>";
                } else {
                    echo "<script>
                            alert('Lỗi: " . mysqli_error($conn) . "');
                            window.location.href='sanbong.php';
                        </script>";
                }
            } 
        }
        else {
            echo "<script>
                    alert('Lỗi: Thiếu tham số ID hoặc thời gian đặt sân.');
                    window.location.href='sanbong.php';
                </script>";
        }
    }else {
        echo "<script>
                alert('Bạn cần đăng nhập để đặt sân.');
                window.location.href='sanbong.php';
            </script>";
    }
?>
