<?php
include 'config.php';

if (isset($_SESSION['login_user'])) {
    $username = $_SESSION['login_user'];
    
    if (isset($_POST['sid'])) {
        $sid = $_POST['sid'];
        
        $query = "INSERT INTO sanyeuthich (IDSan, TenTK) VALUES ('$sid' ,'$username')";
        
        if ($conn->query($query)) {
            echo "success";
        } else {
            echo "error: " . $conn->error;
        }
        $conn->close();
        } else {
            echo "error: Missing sid parameter";
        }
    }                 
?>
